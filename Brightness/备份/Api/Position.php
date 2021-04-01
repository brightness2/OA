<?php
class Api_Position extends MTS_ZApi
{
    public function getRules()
    {
        return array(
            'add' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '职位名称'],
            ),
            'edit' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '职位ID'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '职位名称'],
            ),
            'delete' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '职位ID'],
            ),

            'deleteMore' => array(
                'ids' => ['name' => 'ids', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '职位ID数组'],
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
        $domain = new Domain_Position(new Model_Position());
        return $domain->add($this->name);
    }

    /**
     * 编辑职位
     *
     * @return void
     */
    public function edit()
    {
        $domain = new Domain_Position(new Model_Position());
        return $domain->edit($this->id, $this->name);
    }

    /**
     * 删除职位
     *
     * @return void
     */
    public function delete()
    {
        $domain = new Domain_Position(new Model_Position());
        return $domain->delete($this->id);
    }

    /**
     * 批量删除
     *
     * @return void
     */
    public function deleteMore()
    {
        $domain = new Domain_Position(new Model_Position());
        return $domain->deleteMore($this->ids);
    }
}
