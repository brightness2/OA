<?php
class Api_Department extends MTS_ZApi
{
    public function getRules()
    {
        return array(
            'getTree' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'limit' => ['name' => 'limit', 'default' => 0, 'desc' => '显示条数'],
                'offset' => ['name' => 'page', 'default' => 0, 'desc' => '页数'],
                'order' => ['name' => 'order', 'default' => '', 'desc' => '排序'],
                'searchParams' => ['name' => 'sp', 'type' => 'array', 'format' => 'json', 'desc' => '查询条件'],
                // 'field' => ['name' => 'field', 'default' => '*', 'desc' => '查询的字段'],
            ),
            'add' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '部门名称'],
                'parent_id' => ['name' => 'parent_id', 'require' => true, 'desc' => '上级id'],
            ),
           
            'delete' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '部门ID'],
            ),

            

        );
    }


    /**
     * 获取部门树
     *
     * @return array
     */
    public function getTree()
    {

        $domain = new Domain_Department(new Model_Department());
        return $domain->getTree(
            '*',
            $this->searchParams,
            $this->limit,
            $this->offset,
            $this->order
        );
    }

    /**
     * 添加
     *
     * @return array
     */
    public function add()
    {

        $domain = new Domain_Department(new Model_Department());
        return $domain->add($this->name, $this->parent_id);
    }

    /**
     * 删除
     *
     * @return void
     */
    public function delete()
    {
        $domain = new Domain_Department(new Model_Department());
        return $domain->deleteDep($this->id);
    }
}
