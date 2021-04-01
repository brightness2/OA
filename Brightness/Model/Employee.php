<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-23 11:24:33 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-23 14:46:19
 */
class Model_Employee extends MTS_ZDbobj
{

    /**
     * 设置操作的表
     *
     * @param [type] $id
     * @return void
     */
    public function getTableName($id)
    {
        return 'employee';
    }

    public function addParams($params = array())
    {
        $this->filterParams($params);

        if (isset($params['id']))
            $this->where('id', $params['id']);
        if (isset($params['name']))
            $this->where('name', $params['name']);
        if (isset($params['EmpName']))
            $this->where('name', $params['EmpName'], 'like');
    }

    /**
     * 根据名称获取一条信息
     *
     * @param string $name
     * @return array
     */
    public function getByName($name)
    {
        $param = [
            'name' => $name,
        ];
        $this->addParams($param);
        return  $this->getByParams();
    }
}
