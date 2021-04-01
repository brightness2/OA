<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 11:35:41
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-26 15:46:25
 * @Description:  
 */
class Domain_JwtToken
{

    protected static $exp = 7200; //900
    protected static $nbf = 0;
    protected static $refresh = 7000; //840

    /**
     * 生成token
     *
     * @param int $userId 用户ID
     * @param string $username 用户名称
     * @return void
     */
    public static function genToken($userId, $userName)
    {
        $payload = [
            'userId' => $userId,  //该JWT的签发者
            'iat' => time(),  //签发时间
            'exp' => time() + self::$exp,  //过期时间
            'nbf' => time() + self::$nbf,  //该时间之前不接收处理该Token
            'refresh' => time() + self::$refresh, //刷新token时间
            'userName' => $userName,  //面向的用户
            'jti' => md5(uniqid('JWT') . time())  //该Token唯一标识
        ];
        return Tool_Jwt::getToken($payload);
    }


    /**
     * 检测token是否有效
     *
     * @param string $token
     * @return bool|array
     */
    public static function checkToken($token)
    {
        $payload =  Tool_Jwt::verifyToken($token);

        if (!$payload) {
            throw new MTS_ZException('登录已过期，请重新登录', 401);
        }
        return $payload;
    }



    /**
     * 通过token获取用户ID
     *
     * @param string $token
     * @return int
     */
    public static function getIdByToken($token)
    {
        $payload = self::checkToken($token);
        return $payload['userId'];
    }


    /**
     * 判断是否可以刷新token
     *
     * @param string $token
     * @return boolean
     */
    public static function canRefresh($token)
    {
        $payload = self::checkToken($token);
        //已过期返回false
        if (time() >= $payload['exp']) {
            return false;
        }
        //当前时间小于刷新时间返回false
        if (time() < $payload['refresh']) {
            return false;
        }

        return $payload;
    }

    /**
     * 刷新token
     *
     * @param string $token
     * @return string
     */
    public static function refreshToken($token)
    {
        $payload = self::canRefresh($token);
        //不能刷新，返回原token，否则返回新token
        if (!$payload) {
            return $token;
        } else {
            return self::genToken($payload['userId'], $payload['userName']);
        }
    }
}
