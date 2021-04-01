<?php
/*
 * @Author: Brightness
 * @Date: 2021-01-05 09:49:49
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 16:44:37
 * @Description: 基础接口类
 */
class MTS_ZApi extends PhalApi_Api
{

    // protected $currUser; #当前登录用户

    public function __construct()
    {
        // $this->currUser =  Domain_Authority::checkToken();
        // Domain_Authority::checkPermiss();
    }

    /**
     * 获取接口参数
     *
     * @param string $action
     * @return array
     * @desc 配合 getRules 使用
     * @example
     * @author Brightness
     * @since
     */
    protected function getApiParams($action)
    {
        $data = $this->getRules();
        $result = [];
        foreach ($data[$action] as $key => $param) {
            $result[$key] = $this->$key;
        }
        return $result;
    }
}
