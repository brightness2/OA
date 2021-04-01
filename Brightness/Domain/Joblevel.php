<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-22 17:31:05 
 * @Last Modified by: Brightness
 * @Last Modified time: 2021-03-23 15:15:40
 */
class Domain_Joblevel extends MTS_ZDomain
{

    /**
     * 添加一个职称
     *
     * @param string $name
     * @param string $level
     * @return mixed
     */
    public function add($name, $level)
    {
        $name = trim($name);
        $level = trim($level);
        if (null == $name or '' == $name) {
            throw new MTS_ZException('请输入职称名称');
        }
        if (null == $level or '' == $level) {
            throw new MTS_ZException('请选择职称等级');
        }

        if ($this->modelObj->getByNL($name, $level)) {
            throw new MTS_ZException($name . ' 职称 ' . $level . ' 已存在');
        }
        $data = [
            'name' => $name,
            'level' => $level,
            'create_date' => date('Y-m-d H:i:s'),
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
     * @param string $level
     * @return mixed
     */
    public function edit($id, $name, $level, $enabled)
    {
        $name = trim($name);
        $level = trim($level);

        if (!$id or null == $name or '' == $name or null == $level or '' == $level) {
            throw new MTS_ZException('请选择一条数据');
        }

        $has = $this->modelObj->getByNL($name, $level);
        if ($has and $has['id'] != $id) {
            throw new MTS_ZException($name . ' 职称 ' . $level . ' 已存在');
        }

        $data = [
            'name' => $name,
            'level' => $level,
            'enabled' => $enabled,
        ];
        $res =  $this->update($id, $data);
        if ($res == false) {
            DI()->logger->debug(DI()->request->getService() . ' error:can not edit id:' . $id, json_encode($data));
            throw new MTS_ZException('数据没有变动');
        }

        return $res;
    }
}
