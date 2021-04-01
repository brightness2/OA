<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 11:35:41
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 16:58:52
 * @Description:  登录接口
 */

class Api_Login extends MTS_ZApi
{
    public function getRules()
    {
        return array(

            'login' => array(
                'username' => ['name' => 'username', 'require' => true, 'desc' => '用户名称'],
                'password' => ['name' => 'password', 'require' => true, 'desc' => '密码'],
                'code' => ['name' => 'code', 'require' => true, 'desc' => '验证码'],
            ),

            'logout' => array(),
            'getCaptcha' => array(),

        );
    }

    /**
     * 登录
     *
     * @return void
     */
    public function login()
    {
        $domain = new Domain_Login(new Model_Admin());
        return $domain->doLogin($this->username, $this->password, $this->code);
    }

    /**
     * 退出登录
     *
     * @return void
     */
    public function logout()
    {
        return '注销成功';
    }

    /**
     * 生成验证码
     *
     * @return void
     */
    public function getCaptcha()
    {

        return Domain_Captcha::genCode();
    }
}
