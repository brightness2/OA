<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-25 15:17:39
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-26 12:53:47
 * @Description:  
 */
class Api_Role extends MTS_ZApi
{

    public function getRules()
    {
        return array(
            'add' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '角色名称'],
            ),
            'delete' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '角色ID'],
            ),

        );
    }

    /**
     * 添加
     *
     * @return void
     */
    public function add()
    {
        $domain = new Domain_Role(new Model_Role());
        return $domain->add($this->name);
    }

    /**
     * 删除
     *
     * @return void
     */
    public function delete()
    {
        $domain = new Domain_Role(new Model_Role());
        return $domain->deleteRole($this->id);
    }
}
