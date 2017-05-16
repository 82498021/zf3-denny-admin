<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 13:16
 */

namespace System\Helper;


class SecretHelper
{
    /**
     * 生成随机加密串
     * @return string
     */
   public static function authCode() {

       $length=rand(1,32);

       $str = substr(md5(time()), 0, $length);

       return md5($str);
    }

    /**
     * 生成加密字符串
     * @param $password
     * @param $code
     * @return string
     */
    public static function encryption($password,$code){

        return md5(md5($password.$code));

    }



}