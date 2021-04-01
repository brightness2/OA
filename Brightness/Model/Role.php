<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-17 16:57:50 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-23 10:47:56
 */
class Model_Role  extends MTS_ZDbobj
{
    /**
     * 设置操作的表
     *
     * @param [type] $id
     * @return void
     */
    public function getTableName($id)
    {
        return 'role';
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
        if (isset($params['name_zh']))
            $this->where('name_zh', $params['name_zh']);
    }

    /**
     * 根据名称获取职位
     *
     * @param string $posname
     * @return array user
     */
    public function getByName($name)
    {
        $this->addParams(['name_zh' => $name]);
        return $this->getByParams();
    }
}
