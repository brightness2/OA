<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-17 16:57:50 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-17 18:05:19
 */
class Model_Admin  extends MTS_ZDbobj
{

    /**
     * 设置操作的表
     *
     * @param [type] $id
     * @return void
     */
    public function getTableName($id)
    {
        return 'admin';
    }

    /**
     * 添加查询条件
     *
     * @param array $params
     * @return void
     */
    public function addParams($params = array())
    {
        $this->filterParams($params);

        if (isset($params['id']))
            $this->where('id', $params['id']);
        if (isset($params['name']))
            $this->where('name', $params['name']);
        if (isset($params['username']))
            $this->where('username', $params['username']);
        if (isset($params['adminName']))
            $this->where('name', $params['adminName'], 'like');
    }

    /**
     * 根据用户名称获取用户
     *
     * @param string $username
     * @return array user
     */
    public function getByuserName($username)
    {
        $this->addParams(['username' => $username]);
        return $this->getByParams();
    }
}
