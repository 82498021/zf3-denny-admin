<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 04/05/2017
 * Time: 11:38
 */

namespace System\Authentication\Adapter;


use System\Helper\SecretHelper;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as Adapter;
use Zend\Authentication\Result as AuthenticationResult;
use Zend\Db\Sql;
use Zend\Db\Sql\Expression as SqlExpr;
use Zend\Db\Sql\Predicate\Operator as SqlOp;
use Zend\Authentication\Adapter\DbTable\Exception\RuntimeException;


class CredentialTreatmentAdapter extends Adapter
{

    protected function authenticateCreateSelect()
    {
        // build credential expression
        if (empty($this->credentialTreatment) || (strpos($this->credentialTreatment, '?') === false)) {
            $this->credentialTreatment = '?';
        }


        $credentialExpression = new SqlExpr(
            '(CASE WHEN ?' . ' = ' . $this->credentialTreatment . ' THEN 1 ELSE 0 END) AS ?',
            [$this->credentialColumn, $this->credential, 'zend_auth_credential_match'],
            [SqlExpr::TYPE_IDENTIFIER, SqlExpr::TYPE_VALUE, SqlExpr::TYPE_IDENTIFIER]
        );
        // get select
        $dbSelect = clone $this->getDbSelect();


        $dbSelect->from($this->tableName)
//            ->columns(['*', $credentialExpression])
            ->where(new SqlOp($this->identityColumn, '=', $this->identity));

        return $dbSelect;
    }





    /**
     * _authenticateQuerySelect() - This method accepts a Zend\Db\Sql\Select object and
     * performs a query against the database with that object.
     *
     * @param  Sql\Select $dbSelect
     * @throws RuntimeException when an invalid select object is encountered
     * @return array
     */
    protected function authenticateQuerySelect(Sql\Select $dbSelect)
    {
        $sql = new Sql\Sql($this->zendDb);
        $statement = $sql->prepareStatementForSqlObject($dbSelect);
        try {
            $result = $statement->execute();

            $resultIdentities = [];
            // iterate result, most cross platform way
            foreach ($result as $row) {

                // ZF-6428 - account for db engines that by default return uppercase column names
                if (isset($row['ZEND_AUTH_CREDENTIAL_MATCH'])) {
                    $row['zend_auth_credential_match'] = $row['ZEND_AUTH_CREDENTIAL_MATCH'];
                    unset($row['ZEND_AUTH_CREDENTIAL_MATCH']);
                }

                if($row['password']!==SecretHelper::encryption($this->credential,$row['encrypted'])){
                    $row['zend_auth_credential_match']=0;
                }else{
                    $row['zend_auth_credential_match']=1;
                }

                $resultIdentities[] = $row;
            }
        } catch (\Exception $e) {
            throw new RuntimeException(
                'The supplied parameters to DbTable failed to '
                . 'produce a valid sql statement, please check table and column names '
                . 'for validity.',
                0,
                $e
            );
        }
        return $resultIdentities;
    }


    protected function authenticateCreateAuthResult()
    {
        $userInfo=[
            'key'=>$this->resultRow['id'],
            $this->identityColumn=>$this->resultRow[$this->identityColumn],
            'name'=>$this->resultRow['nick_name'],
        ];

        return new AuthenticationResult(
            $this->authenticateResultInfo['code'],
            $userInfo,
            $this->authenticateResultInfo['messages']
        );
    }

}