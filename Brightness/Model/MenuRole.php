<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-25 16:31:52
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-25 17:06:12
 * @Description:  
 */

class Model_MenuRole  extends MTS_ZDbobj
{
    /**
     * 设置操作的表
     *
     * @param [type] $id
     * @return void
     */
    public function getTableName($id)
    {
        return 'menu_role';
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
        if (isset($params['menu_id']))
            $this->where('menu_id', $params['menu_id']);
        if (isset($params['role_id']))
            $this->where('role_id', $params['role_id']);
    }
}
