<?php
/*
 * @Author: Brightness
 * @Date: 2022-04-01 08:46:24
 * @LastEditors: Brightness
 * @LastEditTime: 2022-04-01 08:46:25
 * @Description:  拦截器配置
*/
/**
 * 拦截器的执行顺序，按照数组排序的顺序执行
 */
return array(
    //所有全局前置
    'beforeInterceptors'=>[
        Interceptor_Before::class,
    ],
    //所有全局后置拦截器
    'afterInterceptors'=>[
        Interceptor_After::class,
    ],
);