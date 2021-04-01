<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 16:47:06
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 16:55:08
 * @Description:  员工接口
 */
class Api_Employee extends MTS_ZApi
{
    protected $payload = null; #jwt载荷

    public function __construct()
    {
        $this->payload =  Domain_Authority::checkToken(); #检查是否登录
        Domain_Authority::checkPermiss(); #校验权限
    }

    public function getRules()
    {
        return array(

            'getList' => array(

                'limit' => ['name' => 'limit', 'default' => 0, 'desc' => '显示条数'],
                'offset' => ['name' => 'page', 'default' => 0, 'desc' => '页数'],
                'order' => ['name' => 'order', 'default' => '', 'desc' => '排序'],
                'searchParams' => ['name' => 'sp', 'type' => 'array', 'format' => 'json', 'desc' => '查询条件'],

            ),
            'add' => array(
                'data' => ['name' => 'data', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '表单数据'],
            ),

            'edit' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '员工ID'],
                'data' => ['name' => 'data', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '表单数据'],
            ),

            'delete' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '员工ID'],
            ),
            'deleteMore' => array(
                'ids' => ['name' => 'ids', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '员工ID数组'],
            ),
        );
    }

    /**
     * 读取列表
     *
     * @return void
     */
    public function getList()
    {

        $domain = new Domain_Employee(new Model_Employee());
        $res = $domain->getList(
            '*',
            $this->searchParams,
            $this->limit,
            $this->offset,
            $this->order
        );
        return $res;
    }

    /**
     * 添加
     *
     * @return array
     */
    public function add()
    {
        $domain = new Domain_Employee(new Model_Employee());
        return $domain->add($this->data);
    }

    /** 
     * 编辑
     *
     * @return void
     */
    public function edit()
    {
        $domain = new Domain_Employee(new Model_Employee());
        return $domain->edit($this->id, $this->data);
    }

    /**
     * 删除
     *
     * @return void
     */
    public function delete()
    {
        $domain = new Domain_Employee(new Model_Employee());
        return $domain->delete($this->id);
    }

    /**
     * 删除多条
     *
     * @return void
     */
    public function deleteMore()
    {
        $domain = new Domain_Employee(new Model_Employee());
        return $domain->deleteMore($this->ids);
    }
}
