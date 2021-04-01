<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 16:47:06
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 17:28:35
 * @Description:  操作员管理接口
 */
class Api_SysAdmin extends MTS_ZApi
{
    protected $payload = null; #jwt载荷

    public function __construct()
    {
        $this->payload =  Domain_Authority::checkToken(); #检查是否登录
        Domain_Authority::checkPermiss(); #校验权限
    }

    public function getRules()
    {
        return array(
            'getList' => array(
                'limit' => ['name' => 'limit', 'default' => 0, 'desc' => '显示条数'],
                'offset' => ['name' => 'page', 'default' => 0, 'desc' => '页数'],
                'order' => ['name' => 'order', 'default' => '', 'desc' => '排序'],
                'searchParams' => ['name' => 'sp', 'type' => 'array', 'format' => 'json', 'desc' => '查询条件'],
            ),
            'delete' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '用户ID'],
            ),
            'setEnabled' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '用户ID'],
                'enabled' => ['name' => 'enabled', 'require' => true, 'desc' => 'enabled 值'],
            ),
            'setRoles' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '用户id'],
                'rids' => ['name' => 'rids', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '角色id数组'],
            ),
        );
    }


    /**
     * 管理员列表
     *
     * @return array
     */
    public function getList()
    {
        $domain = new Domain_User(new Model_Admin());

        return  $domain->getListWithRole(
            'id,name,phone,telephone,address,enabled,username,avatar,remark',
            $this->searchParams,
            $this->limit,
            $this->offset,
            $this->order
        );
    }

    /**
     * 删除
     *
     * @return void
     */
    public function delete()
    {
        $domain = new Domain_User(new Model_Admin());
        return $domain->delete($this->id);
    }

    /**
     * 设置enabled 值
     *
     * @return void
     */
    public function setEnabled()
    {
        $domain = new Domain_User(new Model_Admin());
        return $domain->setEnabled($this->id, $this->enabled);
    }

    /**
     * 设置用户角色
     *
     * @return void
     */
    public function setRoles()
    {
        $domain = new Domain_User(new Model_Admin());
        return $domain->setRoles($this->id, $this->rids);
    }
}
