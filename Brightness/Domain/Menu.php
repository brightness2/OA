<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-24 11:35:41
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 16:26:56
 * @Description:  
 */
class Domain_Menu extends MTS_ZDomain
{

    public function getRoutes($id)
    {
        $rbac = new Domain_Rbac();
        $list = $rbac->getMenusByUser($id);
        return Tool_Tree::list_to_tree($list, 'id', 'parent_id', 'children', null);
    }
}
