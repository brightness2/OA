<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 11:35:41
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 18:04:40
 * @Description:  
 */
class Domain_User extends MTS_ZDomain
{
    /**
     * 获取列表带角色的
     *
     * @param string $fields
     * @param array $sp
     * @param integer $limit
     * @param integer $offset
     * @param string $order
     * @return void
     */
    public function getListWithRole($fields = '*', $sp = [], $limit = 0, $offset = 0, $order = '')
    {
        $list = $this->getList($fields, $sp, $limit, $offset, $order);
        $arr = [];
        foreach ($list as $user) {
            $rbac = new Domain_Rbac();
            $roles =  $rbac->getRolesByUser($user['id']);
            $user['roles'] = $roles;
            $arr[] = $user;
        }
        return $arr;
    }

    /**
     * 根据token获取用户信息
     *
     * @param int $token
     * @return array
     */
    public function getUser($id)
    {
        $user =  $this->modelObj->get($id);
        if (!$user) {
            throw new MTS_ZException('用户不存在');
        }

        unset($user['password']);
        $rbac = new Domain_Rbac();
        $roles =  $rbac->getRolesByUser($user['id']);
        $user['roles'] = $roles;
        return $user;
    }

    /**
     * 更新用户信息
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateUser($id, $data)
    {
        if (!isset($data['username']) or '' == trim($data['username']) or null == $data) {
            throw new MTS_ZException('请填写用户昵称');
        }

        $user = $this->getOne($id);
        if (!$user) {
            throw new MTS_ZException('用户数据不存在');
        }

        $has = $this->modelObj->getByuserName($data['username']);
        if ($has and $has['id'] != $id) {
            throw new MTS_ZException($data['username'] . ' 用户昵称已存在');
        }

        //过滤密码字段
        if (isset($data['password'])) {
            unset($data['password']);
        }

        $res =  $this->update($id, $data);
        if (false === $res) {
            DI()->logger->debug(DI()->request->getService() . ' error,data:', print_r($data));
            throw new MTS_ZException('更新失败');
        }
        return $res;
    }

    /**
     * 设置enabled值
     *
     * @param int $id
     * @param int $enabled
     * @return void
     */
    public function setEnabled($id, $enabled)
    {
        if (null == $enabled or '' == trim($enabled) or !in_array($enabled, [0, 1, '0', '1'])) {
            throw new MTS_ZException('enabled 参数必须是0或1');
        }

        $res = $this->update($id, ['enabled' => $enabled]);
        if (false === $res) {
            DI()->logger->debug(DI()->request->getService() . ' error,data:', print_r($enabled));
            throw new MTS_ZException('设置失败');
        }

        return $res;
    }

    /**
     * 设置用户角色
     *
     * @param integer $userId
     * @param array $roleIds
     * @return void
     */
    public function setRoles($userId, $roleIds)
    {
        $ar_model = new Model_AdminRole();
        $ar_model->deleteByParams(['admin_id' => $userId]);
        foreach ($roleIds as $rid) {
            $ar_model->insert(['admin_id' => $userId, 'role_id' => $rid]);
        }
        return true;
    }

    /**
     * 修改密码
     *
     * @param int $id
     * @param string $oldPass
     * @param string $pass 新密码
     * @return void
     */
    public function updatePassword($id, $oldPass, $pass)
    {

        $user = $this->getOne($id);
        if (!$user) {
            throw new MTS_ZException('用户数据不存在');
        }

        $oldPass = Domain_Login::encryptPwd($oldPass);
        if ($oldPass !== $user['password']) {
            throw new MTS_ZException('原密码错误');
        }

        $data = ['password' => Domain_Login::encryptPwd($pass)];
        $res = $this->update($id, $data);
        if (false === $res) {
            throw new MTS_ZException('更新失败');
        }
        return $res;
    }
}
