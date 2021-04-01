<?php
/*
 * @Author: Brightness 
 * @Date: 2021-03-22 17:31:05 
 * @Last Modified by: mikey.zhaopeng
 * @Last Modified time: 2021-03-25 09:24:29
 */
class Domain_Employee extends MTS_ZDomain
{


    /**
     * 添加
     *
     * @param array $data
     * @return void
     */
    public function add($data)
    {
        $rules = ['name' => 'required'];
        $errmsg = [];
        $valid =  DI()->validate->check($data, $rules, $errmsg);
        if (true !== $valid) {
            throw new MTS_ZException($valid);
        }
        $res =  $this->insert($data);
        if (!$res) {
            DI()->logger->debug(DI()->request->getService() . ' error,data:', print_r($data));
            throw new MTS_ZException('添加失败');
        }
        return $res;
    }

    /**
     * 编辑
     *
     * @param int $id
     * @param array $data
     * @return void
     */
    public function edit($id, $data)
    {
        if (null == $id or !is_numeric($id)) {
            throw new MTS_ZException('缺少ID,必须是数字');
        }

        $rules = ['gender' => 'required'];
        $errmsg = ['gender' => ['required' => '性别 必须填']];

        $valid = DI()->validate->check($data, $rules, $errmsg);
        if (true !== $valid) {
            throw new MTS_ZException($valid);
        }

        $res = $this->update($id, $data);
        if (false === $res) {
            DI()->logger->debug(DI()->request->getService() . 'error,data:', print_r($data));
            throw new MTS_ZException('更新失败');
        }
        return $res;
    }
}
