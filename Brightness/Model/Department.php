<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-17 16:57:50 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-23 16:13:41
 */
class Model_Department  extends MTS_ZDbobj
{
    /**
     * 设置操作的表
     *
     * @param [type] $id
     * @return void
     */
    public function getTableName($id)
    {
        return 'department';
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
        if (isset($params['parent_id']))
            $this->where('parent_id', $params['parent_id']);
    }

    /**
     * 根据名称获取
     *
     * @param string $posname
     * @return array user
     */
    public function getByName($name)
    {
        $this->addParams(['name' => $name]);
        return $this->getByParams();
    }

    /**
     * 根据父级ID获取所属子部门
     *
     * @param int $pid
     * @return array
     */
    public function getChildren($pid)
    {
        $this->addParams(['parent_id'=>$pid]);
        return $this->setQuery();
    }
}
