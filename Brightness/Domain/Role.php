<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-25 15:15:04
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 08:56:33
 * @Description:  
 */
class Domain_Role extends MTS_ZDomain
{
    /**
     * 添加
     *
     * @param string $name
     * @return void
     */
    public function add($name)
    {
        $name = trim($name);
        if (null == $name or '' == $name) {
            throw new MTS_ZException('角色名称不能为空');
        }
        if ($this->modelObj->getByName($name)) {
            throw new MTS_ZException($name . ' 角色已存在');
        }
        $res = $this->insert(['name_zh' => $name]);
        if (!$res) {
            DI()->logger->debug(DI()->request->getService() . ' error,data:', print_r($name));
            throw new MTS_ZException('添加失败');
        }
        return $res;
    }

    /**
     * 删除角色
     *
     * @param int $roleId
     * @return void
     */
    public function deleteRole($roleId)
    {
        $rbac_domain = new Domain_Rbac();
        $menus = $rbac_domain->getMenusByRole($roleId);
        if ($menus and count($menus) > 0) {
            throw new MTS_ZException('角色存在权限资源，请先删除');
        }
        $res = $this->delete($roleId);
        if (!$res) {
            DI()->logger->debug(DI()->request->getService() . ' error,data', print_r($roleId));
            throw new MTS_ZException('删除失败');
        }
        return $res;
    }
}
