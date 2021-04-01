<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-26 13:51:45
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-26 15:54:59
 * @Description:  
 */

class Domain_Authority
{

    /**
     * 检查token
     *
     * @return void
     */
    public static function checkToken()
    {
        $token = DI()->request->get('token');
        return Domain_JwtToken::checkToken($token);
    }

    /**
     * 检查权限
     * @desc 当前只做页面的检查，没有细化到具体操作
     * @return array
     */
    public static function checkPermiss()
    {
        $token = DI()->request->get('token');
        $userId = Domain_JwtToken::getIdByToken($token);
        $domain = new Domain_Rbac();
        $menus = $domain->getMenusByUser($userId);
        $api = strtolower(DI()->request->getServiceApi());
        $permiss = [];
        foreach ($menus as $menu) {
            $permiss[] = $menu['url'];
        }
        if (!in_array($api, $permiss)) {
            throw new MTS_ZException('权限不足，请联系管理员', 403);
        }
        return $menus;
    }
}
