<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 11:35:41
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 16:54:04
 * @Description:  公共接口
 */
class Api_Console extends MTS_ZApi
{
    protected $payload = null; #jwt载荷
    public function __construct()
    {
        $this->payload =  Domain_Authority::checkToken(); #检查是否登录
    }

    public function getRules()
    {
        return array(
            'getRoutes' => array(),
            'getRoles' => array(),
        );
    }


    /**
     * 侧边栏菜单
     *
     * @return void
     */
    public function getRoutes()
    {

        $domain = new Domain_Menu(new Model_Menu());
        $menus =  $domain->getRoutes($this->payload['userId']);
        return $menus[0]['children'];
    }

    /**
     * 获取所有角色
     *
     * @return void
     */
    public function getRoles()
    {
        $domain = new Domain_Role(new Model_Role());
        return $domain->getList('id,name_zh');
    }
}
