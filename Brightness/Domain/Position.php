<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-22 17:31:05 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-23 15:26:43
 */
class Domain_Position extends MTS_ZDomain
{

    /**
     * 添加一个职位
     *
     * @param string $name
     * @return mixed
     */
    public function add($name)
    {
        $name = trim($name);
        if (null == $name or '' == $name) {
            throw new MTS_ZException('请输入职位名称');
        }
        if ($this->modelObj->getByName($name)) {
            throw new MTS_ZException($name . ' 职位已存在');
        }
        $data = [
            'name' => $name,
            'create_date' => date('Y-m-d'),
            'enabled' => 1,
        ];
        $res = $this->insert($data);
        if (!$res) {
            DI()->logger->debug(DI()->request->getService() . ' error:can not add', json_encode($data));
            throw new MTS_ZException('添加失败');
        }
        return $res;
    }

    /**
     * 根据ID修改一条数据
     *
     * @param int $id
     * @param string $name
     * @return mixed
     */
    public function edit($id, $name)
    {
        $name = trim($name);
        if (!$id or null == $name or '' == $name) {
            throw new MTS_ZException('请选择一条数据');
        }
        $has = $this->modelObj->getByName($name);
        if ($has and $has['id'] != $id) {
            throw new MTS_ZException($name . ' 职位已存在');
        }

        $data = [
            'name' => $name
        ];
        $res =  $this->update($id, $data);
        if (!$res) {
            DI()->logger->debug(DI()->request->getService() . ' error:can not edit id:' . $id, json_encode($data));
            throw new MTS_ZException('数据没有变动');
        }

        return $res;
    }
}
