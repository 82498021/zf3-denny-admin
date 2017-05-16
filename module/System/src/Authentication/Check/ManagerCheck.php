<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 19:30
 */

namespace System\Authentication\Check;



use Zend\Mvc\MvcEvent;

class ManagerCheck
{
    /**
     * @var \Zend\Authentication\AuthenticationService $authService
     */
    private static $authService;
    /**
     * @var \Zend\Router\Http\RouteMatch $match
     */
    private static $match;
    /**
     * @var \Zend\Http\PhpEnvironment\Response $response
     */
    private static $response;
    /**
     * @var \Zend\Http\PhpEnvironment\Request $request
     */
    private static $request;

    private static $routeArray;


    public static function isCheck(MvcEvent $e)
    {

        /**
         * @var \Zend\Router\Http\RouteMatch $match
         */
        self::$match       = $e->getRouteMatch();
        /**
         * @var \Zend\Http\PhpEnvironment\Response $response
         */
        self::$response = $e->getResponse();
        /**
         * @var \Zend\Http\PhpEnvironment\Request $request
         */
        self::$request =$e->getRequest();
        /**
         * @var \Zend\Authentication\AuthenticationService $authService
         */
        $container = $e->getApplication()->getServiceManager();

        $routeName   = self::$match->getMatchedRouteName();

        self::$routeArray=explode('/',$routeName);

        if(!is_array(self::$routeArray)){
            return false;
        }


        switch(self::$routeArray[0]){
            case "admin":
                self::$authService = $container->get("AuthService");
                $e->getViewModel()->setTemplate("layout/admin");
                self::verifyAdmin();
                break;
            case "home";

                $e->getViewModel()->setTemplate("layout/home");

                break;
            case "user";
                self::$authService = $container->get("UserAuthService");
                $e->getViewModel()->setTemplate("layout/user");
                self::checkUserStart();
                break;
        }
    }

    /**
     * 验证后台权限
     */
    private static function verifyAdmin(){



        if (self::$authService->hasIdentity()){
            return;
        }elseif(in_array("login",self::$routeArray)){
            echo "false";
        }else{
            self::$response->getHeaders()->addHeaderLine("Location",self::$request->getBaseUrl().'/login');
            self::$response->setStatusCode(303);
        }
    }


    private static function checkUserStart(){
        if (self::$authService->hasIdentity()){
            return;
        }else{
            self::$response->getHeaders()->addHeaderLine("Location",self::$request->getBaseUrl().'/');
            self::$response->setStatusCode(303);
        }
    }






}