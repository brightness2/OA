<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-17 17:09:50 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-23 11:13:39
 */
class MTS_ZDomain
{
    public $modelObj; #model 实例

    public function __construct($modelObj)
    {

        $this->modelObj = $modelObj;
    }


    /**
     * 批量查询
     *
     * @param string $fields
     * @param array $sp
     * @param integer $limit
     * @param integer $offset
     * @param string $order
     * @param object $modelObj
     * @return array
     */
    public function getList($fields = '*', $sp = [], $limit = 0, $offset = 0, $order = '', $modelObj = null)
    {
        $modelObj = $modelObj ? $modelObj : $this->modelObj;

        $params = [
            'limit' => $limit,
            'offset' => $offset,
            'order' => $order,
        ];

        if (count($sp) > 0) {
            $params = array_merge($params, $sp);
        }
        $modelObj->addParams($params);
        return $modelObj->setQuery($fields);
    }

    /**
     * 获取一条数据
     *
     * @param [type] $id
     * @param object $modelObj
     * @return void
     */
    public function getOne($id, $modelObj = null)
    {
        $modelObj = $modelObj ? $modelObj : $this->modelObj;

        return $modelObj->get($id);
    }

    /**
     * 插入一条数据
     *
     * @param [type] $data
     * @param object $modelObj
     * @return void
     */
    public function insert($data, $modelObj = null)
    {
        $modelObj = $modelObj ? $modelObj : $this->modelObj;

        return $modelObj->insert($data);
    }

    /**
     * 更新一条数据
     *
     * @param [type] $id
     * @param [type] $data
     * @param object $modelObj
     * @return void
     */
    public function update($id, $data, $modelObj = null)
    {
        $modelObj = $modelObj ? $modelObj : $this->modelObj;

        return $modelObj->update($id, $data);
    }

    /**
     * 删除一条数据
     *
     * @param [type] $id
     * @param object $modelObj
     * @return void
     */
    public function delete($id, $modelObj = null)
    {
        $modelObj = $modelObj ? $modelObj : $this->modelObj;

        return $modelObj->delete($id);
    }

    /**
     * 批量删除
     *
     * @param array $ids
     * @param object $modelObj
     * @return void
     */
    public function deleteMore($ids = [], $modelObj = null)
    {
        $modelObj = $modelObj ? $modelObj : $this->modelObj;

        if (!is_array($ids) or count($ids) <= 0) {
            return;
        }


        foreach ($ids as $id) {
            $modelObj->delete($id);
        }

        return true;
    }
}
