<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-25 16:31:52
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-26 11:26:55
 * @Description:  
 */

class Model_AdminRole  extends MTS_ZDbobj
{
    /**
     * 设置操作的表
     *
     * @param [type] $id
     * @return void
     */
    public function getTableName($id)
    {
        return 'admin_role';
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
        if (isset($params['admin_id']))
            $this->where('admin_id', $params['admin_id']);
        if (isset($params['role_id']))
            $this->where('role_id', $params['role_id']);
    }

    /**
     * 根据用户id和角色id获取adminRole中间表数据
     *
     * @param int $userId
     * @param int $roleId
     * @return array
     */
    public function getByadminAndRole($userId, $roleId)
    {
        $this->addParams(['admin_id' => $userId, 'role_id' => $roleId]);
        return $this->getByParams();
    }
}
