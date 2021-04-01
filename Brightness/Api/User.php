<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 11:35:41
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 17:59:29
 * @Description:  用户信息接口
 */
class Api_User extends MTS_ZApi
{

    protected $payload = null; #jwt载荷

    public function __construct()
    {
        $this->payload =  Domain_Authority::checkToken(); #检查是否登录
    }
    public function getRules()
    {
        return array(
            'getUser' => array(
                'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
            ),
            'editUser' => array(
                'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'data' => ['name' => 'data', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '用户信息'],
            ),
            'updatePassword' => array(
                'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'pass' => ['name' => 'pass', 'require' => true, 'desc' => '新密码'],
                'oldPass' => ['name' => 'oldPass', 'require' => true, 'desc' => '旧密码'],
            ),
        );
    }
    /**
     * 获取用户信息
     *
     * @return array
     */
    public function getUser()
    {
        $domain = new Domain_User(new Model_Admin());
        return $domain->getUser($this->payload['userId']);
    }

    /**
     * 编辑当前用户信息
     *
     * @return void
     */
    public function editUser()
    {
        $domain = new Domain_User(new Model_Admin());
        return $domain->updateUser($this->payload['userId'], $this->data);
    }

    /**
     * 更新密码
     *
     * @return void
     */
    public function updatePassword()
    {
        $domain = new Domain_User(new Model_Admin());
        return $domain->updatePassword($this->payload['userId'], $this->oldPass, $this->pass);
    }
}
