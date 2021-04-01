<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-23 11:24:33 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-23 14:46:19
 */
class Model_Joblevel extends MTS_ZDbobj
{

    /**
     * 设置操作的表
     *
     * @param [type] $id
     * @return void
     */
    public function getTableName($id)
    {
        return 'joblevel';
    }

    public function addParams($params = array())
    {
        $this->filterParams($params);

        if (isset($params['id']))
            $this->where('id', $params['id']);
        if (isset($params['name']))
            $this->where('name', $params['name']);
        if (isset($params['level']))
            $this->where('level', $params['level']);
    }

    /**
     * 根据职称和等级获取一条信息
     *
     * @param string $name
     * @param string $level
     * @return array
     */
    public function getByNL($name, $level)
    {
        $param = [
            'name' => $name,
            'level' => $level
        ];
        $this->addParams($param);
        return  $this->getByParams();
    }
}
