<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 16:47:06
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 17:00:34
 * @Description:  基础信息管理接口
 */
class Api_SysBase extends MTS_ZApi
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
            //////部门///////
            'getDepTree' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'limit' => ['name' => 'limit', 'default' => 0, 'desc' => '显示条数'],
                'offset' => ['name' => 'page', 'default' => 0, 'desc' => '页数'],
                'order' => ['name' => 'order', 'default' => '', 'desc' => '排序'],
                'searchParams' => ['name' => 'sp', 'type' => 'array', 'format' => 'json', 'desc' => '查询条件'],
                // 'field' => ['name' => 'field', 'default' => '*', 'desc' => '查询的字段'],
            ),
            'addDep' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '部门名称'],
                'parent_id' => ['name' => 'parent_id', 'require' => true, 'desc' => '上级id'],
            ),

            'deleteDep' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '部门ID'],
            ),
            /////////职位/////////
            'getPosList' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'limit' => ['name' => 'limit', 'default' => 0, 'desc' => '显示条数'],
                'offset' => ['name' => 'page', 'default' => 0, 'desc' => '页数'],
                'order' => ['name' => 'order', 'default' => '', 'desc' => '排序'],
                'searchParams' => ['name' => 'sp', 'type' => 'array', 'format' => 'json', 'desc' => '查询条件'],
                // 'field' => ['name' => 'field', 'default' => '*', 'desc' => '查询的字段'],
            ),
            'addPos' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '职位名称'],
            ),
            'editPos' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '职位ID'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '职位名称'],
            ),
            'deletePos' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '职位ID'],
            ),

            'deleteMorePos' => array(
                'ids' => ['name' => 'ids', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '职位ID数组'],
            ),
            /////////职称//////////////
            'getJobList' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'limit' => ['name' => 'limit', 'default' => 0, 'desc' => '显示条数'],
                'offset' => ['name' => 'page', 'default' => 0, 'desc' => '页数'],
                'order' => ['name' => 'order', 'default' => '', 'desc' => '排序'],
                'searchParams' => ['name' => 'sp', 'type' => 'array', 'format' => 'json', 'desc' => '查询条件'],
                // 'field' => ['name' => 'field', 'default' => '*', 'desc' => '查询的字段'],
            ),
            'addJob' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '职称名称'],
                'level' => ['name' => 'level', 'require' => true, 'desc' => '职称等级'],
            ),
            'editJob' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '职称ID'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '职称名称'],
                'level' => ['name' => 'level', 'require' => true, 'desc' => '职称等级'],
                'enabled' => ['name' => 'enabled', 'desc' => '是否开启'],
            ),
            'deleteJob' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '职称ID'],
            ),

            'deleteMoreJob' => array(
                'ids' => ['name' => 'ids', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '职称ID数组'],
            ),
            //////////角色///////////
            'getRoleList' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'limit' => ['name' => 'limit', 'default' => 0, 'desc' => '显示条数'],
                'offset' => ['name' => 'page', 'default' => 0, 'desc' => '页数'],
                'order' => ['name' => 'order', 'default' => '', 'desc' => '排序'],
                'searchParams' => ['name' => 'sp', 'type' => 'array', 'format' => 'json', 'desc' => '查询条件'],
                // 'field' => ['name' => 'field', 'default' => '*', 'desc' => '查询的字段'],
            ),
            'addRole' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'name' => ['name' => 'name', 'require' => true, 'desc' => '角色名称'],
            ),
            'deleteRole' => array(
                'id' => ['name' => 'id', 'require' => true, 'desc' => '角色ID'],
            ),
            ///////////////////其它////////////
            'getMenuList' => array(
                // 'token' => ['name' => 'token', 'require' => true, 'desc' => 'token'],
                'limit' => ['name' => 'limit', 'default' => 0, 'desc' => '显示条数'],
                'offset' => ['name' => 'page', 'default' => 0, 'desc' => '页数'],
                'order' => ['name' => 'order', 'default' => '', 'desc' => '排序'],
                'searchParams' => ['name' => 'sp', 'type' => 'array', 'format' => 'json', 'desc' => '查询条件'],
                // 'field' => ['name' => 'field', 'default' => '*', 'desc' => '查询的字段'],
            ),
            'getPermiss' => array(
                'roleId' => ['name' => 'rid', 'require' => true, 'desc' => '角色id'],
            ),
            'updatePermiss' => array(
                'roleId' => ['name' => 'rid', 'require' => true, 'desc' => '角色id'],
                'mids' => ['name' => 'mids', 'require' => true, 'type' => 'array', 'format' => 'json', 'desc' => '菜单id数组'],
            ),
        );
    }

    /*****************************部门 */
    /**
     * 获取部门树
     *
     * @return array
     */
    public function getDepTree()
    {

        $domain = new Domain_Department(new Model_Department());
        return $domain->getTree(
            '*',
            $this->searchParams,
            $this->limit,
            $this->offset,
            $this->order
        );
    }

    /**
     * 添加
     *
     * @return array
     */
    public function addDep()
    {

        $domain = new Domain_Department(new Model_Department());
        return $domain->add($this->name, $this->parent_id);
    }

    /**
     * 删除
     *
     * @return void
     */
    public function deleteDep()
    {
        $domain = new Domain_Department(new Model_Department());
        return $domain->deleteDep($this->id);
    }

    /**********************职位 */
    public function getPosList()
    {

        $domain = new Domain_Position(new Model_Position());
        return $domain->getList(
            '*',
            $this->searchParams,
            $this->limit,
            $this->offset,
            $this->order
        );
    }
    /**
     * 添加职位
     *
     * @return void
     */
    public function addPos()
    {
        $domain = new Domain_Position(new Model_Position());
        return $domain->add($this->name);
    }

    /**
     * 编辑职位
     *
     * @return void
     */
    public function editPos()
    {
        $domain = new Domain_Position(new Model_Position());
        return $domain->edit($this->id, $this->name);
    }

    /**
     * 删除职位
     *
     * @return void
     */
    public function deletePos()
    {
        $domain = new Domain_Position(new Model_Position());
        return $domain->delete($this->id);
    }

    /**
     * 批量删除
     *
     * @return void
     */
    public function deleteMorePos()
    {
        $domain = new Domain_Position(new Model_Position());
        return $domain->deleteMore($this->ids);
    }
    /******************* 职称*/
    public function getJobList()
    {

        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->getList(
            '*',
            $this->searchParams,
            $this->limit,
            $this->offset,
            $this->order
        );
    }

    /**
     * 添加职称
     *
     * @return void
     */
    public function addJob()
    {
        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->add($this->name, $this->level);
    }

    /**
     * 编辑职称
     *
     * @return void
     */
    public function editJob()
    {
        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->edit($this->id, $this->name, $this->level, $this->enabled);
    }

    /**
     * 删除职称
     *
     * @return void
     */
    public function deleteJob()
    {
        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->delete($this->id);
    }

    /**
     * 批量删除
     *
     * @return void
     */
    public function deleteMoreJob()
    {
        $domain = new Domain_Joblevel(new Model_Joblevel());
        return $domain->deleteMore($this->ids);
    }

    /************************角色*** */
    public function getRoleList()
    {

        $domain = new Domain_Role(new Model_Role());
        return $domain->getList(
            '*',
            $this->searchParams,
            $this->limit,
            $this->offset,
            $this->order
        );
    }
    /**
     * 添加
     *
     * @return void
     */
    public function addRole()
    {
        $domain = new Domain_Role(new Model_Role());
        return $domain->add($this->name);
    }

    /**
     * 删除
     *
     * @return void
     */
    public function deleteRole()
    {
        $domain = new Domain_Role(new Model_Role());
        return $domain->deleteRole($this->id);
    }

    /***************************其它 */
    public function getMenuList()
    {
        $domain = new Domain_Menu(new Model_Menu());

        $menus =  $domain->getList(
            '*',
            $this->searchParams,
            $this->limit,
            $this->offset,
            $this->order
        );
        return Tool_Tree::list_to_tree($menus, 'id', 'parent_id', 'children', null);
    }

    /**
     * 获取角色资源
     *
     * @return void
     */
    public function getPermiss()
    {
        $domain = new Domain_Rbac();
        $menus =  $domain->getMenusByRole($this->roleId);
        $arr = [];
        foreach ($menus as $menu) {
            if ($menu['url']) {
                $arr[] = $menu['menu_id'];
            }
        }
        return $arr;
    }

    /**
     * 更新角色的资源
     *
     * @return void
     */
    public function updatePermiss()
    {
        $domain = new Domain_Rbac();
        return $domain->updatePermiss($this->roleId, $this->mids);
    }
}
