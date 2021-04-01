<?php
class Api_Joblevel extends MTS_ZApi
{
    public function getRules()
    {
        return array(
            'add' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '职称名称'],
                'level' => ['name' => 'level', 'require' => true, 'desc' => '职称等级'],
            ),
            'edit' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '职称ID'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '职称名称'],
                'level' => ['name' => 'level', 'require' => true, 'desc' => '职称等级'],
                'enabled' => ['name' => 'enabled', 'desc' => '是否开启'],
            ),
            'delete' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '职称ID'],
            ),

            'deleteMore' => array(
                'ids' => ['name' => 'ids', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '职称ID数组'],
            ),

        );
    }

    /**
     * 添加职位
     *
     * @return void
     */
    public function add()
    {
        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->add($this->name, $this->level);
    }

    /**
     * 编辑职位
     *
     * @return void
     */
    public function edit()
    {
        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->edit($this->id, $this->name, $this->level, $this->enabled);
    }

    /**
     * 删除职位
     *
     * @return void
     */
    public function delete()
    {
        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->delete($this->id);
    }

    /**
     * 批量删除
     *
     * @return void
     */
    public function deleteMore()
    {
        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->deleteMore($this->ids);
    }
}
