<?php
/*
 * @Author: Brightness
 * @Date: 2020-10-21 16:49:49
 * @LastEditors: Brightness
 * @LastEditTime: 2020-10-21 18:21:15
 * @Description: 登录
 */
class Domain_Login extends MTS_ZDomain
{

    /**
     * 登录 返回token
     *
     * @param string $username
     * @param string $password
     * @param string $code
     * @return void
     */
    public function doLogin($username, $password, $code)
    {

        $checkCode = Domain_Captcha::checkCode($code);
        if (!$checkCode) {
            throw new MTS_ZException('验证码错误');
        }

        $user = $this->checkNameAndPwd($username, $password);

        $token = Domain_JwtToken::genToken($user['id'], $user['username']);
        return [
            'token' => $token,
            'user' => [
                'name' => $user['name'],
                'username' => $user['username'],
                'avatar' => $user['avatar'],
            ],
        ];
    }

    /**
     * 根据token获取用户信息
     *
     * @param string $token
     * @return array
     */
    public function getUserByToken($token)
    {
        $userId = Domain_JwtToken::getIdByToken($token);
        return $this->modelObj->get($userId);
    }



    /**
     * 校验输入用户名和密码
     *
     * @param string $username
     * @param string $password
     * @return array user
     */
    public function checkNameAndPwd($username, $password)
    {
        if (null == $username or '' == $username) {
            throw new MTS_ZException('用户名不能为空');
        }

        if (null == $password or '' == $password) {
            throw new MTS_ZException('密码不能为空');
        }

        $user = $this->modelObj->getByuserName($username);

        if (!$user) {
            throw new MTS_ZException($username . ' 用户不存在');
        }

        if ($user['enabled'] != 1) {
            throw new MTS_ZException($username . ' 用户被禁用了,请联系管理员');
        }

        if ($user['password'] != self::encryptPwd($password)) {
            throw new MTS_ZException('密码错误，请重新输入');
        }

        return $user;
    }

    /**
     * 密码加密算法
     *
     * @param string $password
     * @return string
     */
    public static function encryptPwd($password)
    {
        return md5($password);
    }
}
