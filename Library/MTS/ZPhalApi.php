<?php
/*
 * @Author: Brightness
 * @Date: 2020-10-20 09:23:00
 * @LastEditors: Brightness
 * @LastEditTime: 2020-10-20 10:57:26
 * @Description: 仿照 /PhalApi/PhalApi.php
 */
/**
 * 框架版本号
 */
defined('PHALAPI_VERSION') || define('PHALAPI_VERSION', '1.4.2');
 
/**
 * 项目根目录
 */
defined('PHALAPI_ROOT') || define('PHALAPI_ROOT', dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'PhalApi');


require_once PHALAPI_ROOT . DIRECTORY_SEPARATOR . 'PhalApi' . DIRECTORY_SEPARATOR . 'Loader.php';
require_once PHALAPI_ROOT . DIRECTORY_SEPARATOR . 'PhalApi' . DIRECTORY_SEPARATOR . 'bootstrap.php';

/**
 * PhalApi 应用类
 *
 * - 实现远程服务的响应、调用等操作
 * 
 * <br>使用示例：<br>
```
 * $api = new PhalApi();
 * $rs = $api->response();
 * $rs->output();
```
 *
 * @package     PhalApi\Response
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2014-12-17
 */

class MTS_ZPhalApi {
    
    /**
     * 响应操作
     *
     * 通过工厂方法创建合适的控制器，然后调用指定的方法，最后返回格式化的数据。
     *
     * @return mixed 根据配置的或者手动设置的返回格式，将结果返回
     *  其结果包含以下元素：
```
     *  array(
     *      'ret'   => 200,	            //服务器响应状态
     *      'data'  => array(
     *           'code' => 0, #业务错误码
     *           'result' => array(),#业务正常的数据
     *           'errmsg' => ''#业务错误信息
     *      ),	        //正常并成功响应后，返回给客户端的数据	
     *      'msg'   => '',		        //错误提示信息
     *  );
```
     */
    public function response() {
        $di = DI();
        $rs = $di->response;
        try {
            // 接口调度与响应
            $api    = PhalApi_ApiFactory::generateService(); 
            $action = $di->request->getServiceAction();
            // 执行api前
            // $data  = call_user_func(array($api, $action));//执行api中
            // 执行api后
            //使用拦截器
            $InterceptorManage = new Interceptor_Lib;
            $data = $InterceptorManage->action($api);
            //
            $rs->setData($data);
        } catch (MTS_ZException $ex) {
            // Brightness 业务异常
            $rs->setCode( $ex->getCode());#Brightness 2020-10-20
            $rs->setErrmsg( $ex->getMessage());#Brightness 2020-10-20
         
        } catch (PhalApi_Exception $ex) {
            // 框架或项目可控的异常
            $rs->setRet($ex->getCode());
            $rs->setMsg($ex->getMessage());
        } catch (Exception $ex) {
            // 不可控的异常
            $di->logger->error($di->request->getService(), strval($ex));

            if ($di->debug) {
                $rs->setRet($ex->getCode());
                $rs->setMsg($ex->getMessage());
                $rs->setDebug('exception', $ex->getTrace());
            } else {
                throw $ex;
            }
        }

        $rs->setDebug('stack', $di->tracer->getStack());
        $rs->setDebug('sqls', $di->tracer->getSqls());
        $rs->setDebug('version', PHALAPI_VERSION);

        return $rs;
    }
    
}
