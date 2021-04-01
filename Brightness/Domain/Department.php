<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-22 17:31:05 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-23 17:14:26
 */
class Domain_Department extends MTS_ZDomain
{
    /**
     * 获取部门树
     *
     * @param string $fields
     * @param array $sp
     * @param integer $limit
     * @param integer $offset
     * @param string $order
     * @param object $modelObj
     * @return void
     */
    public function getTree($fields = '*', $sp = [], $limit = 0, $offset = 0, $order = '')
    {
        $list = $this->getList($fields, $sp, $limit, $offset, $order, null);
        $tree = Tool_Tree::list_to_tree($list, 'id', 'parent_id', 'children', 0);
        return $tree;
    }

    /**
     * 添加
     *
     * @param string $name
     * @param int $parentId
     * @return mixed
     */
    public function add($name, $parentId)
    {
        $name = trim($name);
        if (null == $name or '' == $name) {
            throw new MTS_ZException('请输入部门名称');
        }
        if (!is_numeric($parentId)) {
            throw new MTS_ZException('缺少父级ID,必须是数字');
        }
        if ($this->modelObj->getByName($name)) {
            throw new MTS_ZException($name . ' 部门已存在');
        }


        $parent = null;
        if ($parentId > 0) {
            $parent = $this->getOne($parentId);
            if (!$parent) {
                throw new MTS_ZException('添加失败，找不到父级');
            }
        }
        //父级is_parent 改为 1
        if ($parent) {
            $this->update($parentId, ['is_parent' => 1]);
        }

        $data = [
            'name' => $name,
            'parent_id' => $parentId,
            'enabled' => 1,
            'is_parent' => 0,
        ];

        $res =  $this->insert($data);
        if (!$res) {
            DI()->logger->debug(DI()->request->getService() . ' error,can not add data:', json_encode($data));
            throw new MTS_ZException('添加失败');
        }

        return $res;
    }

    /**
     * 删除部门
     *
     * @param int $id
     * @return void
     */
    public function deleteDep($id)
    {
        $row = $this->getOne($id);
        if(!$row){
            throw new MTS_ZException('数据不存在');
        }

        //判断是否存在子部门,是则无法删除
        if($row['is_parent']){
            throw new MTS_ZException('存在子部门无法删除');
        }

        $res =  $this->delete($id);

        //判断父级是否存在子部门，否则设置父级is_parent 为0
        if($row['parent_id']){
            $pChildren = $this->modelObj->getChildren($row['parent_id']);
            if(!$pChildren){
                $this->update($row['parent_id'],['is_parent'=>0]);
            }
        }

        return $res;
    }
}
