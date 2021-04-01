<?php
/*
 * @Author: Brightness
 * @Date: 2021-03-25 16:08:41
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-29 16:33:55
 * @Description:  RBAC
 */
class Domain_Rbac
{
    /**
     * 根据用户id获取角色
     *
     * @param int $userId
     * @return array
     */
    public function getRolesByUser($userId)
    {
        $model = new Model_AdminRole();
        $model->addParams(['admin_id' => $userId]);
        return $model->setQuery('admin_role.*,role.name_zh,admin.name AS adname');
    }

    /**
     * 根据角色id获取菜单
     *
     * @param int $roleId
     * @return array
     */
    public function getMenusByRole($roleId)
    {
        $model = new Model_MenuRole();
        $model->addParams(['role_id' => $roleId]);
        return $model->setQuery('menu_role.*,role.name AS rname,menu.*');
    }

    /**
     * 根据用户id获取菜单
     *
     * @return array
     */
    public function getMenusByUser($userId)
    {
        $sql = "SELECT
            DISTINCT
            mr.menu_id,
            m.*
            FROM
            menu_role mr
            LEFT JOIN
            menu m
            ON
            mr.menu_id = m.id
            WHERE
            mr.role_id
            IN (
                SELECT
                ar.role_id
                FROM
                admin_role ar
                WHERE
                admin_id = {$userId}
        )
        ORDER BY
            mr.menu_id
        ";

        $model = new Model_MenuRole();
        return $model->queryAll($sql);
    }

    /**
     * 根据用户id 和角色id获取菜单
     *
     * @param int $userId
     * @param int $roleId
     * @return array
     */
    public function getMenusByUserAndRole($userId, $roleId)
    {
        $sql = "SELECT 
                m. * , 
                mr.menu_id, 
                mr.role_id, 
                r.name_zh AS role_name
            FROM 
                menu m, 
                menu_role mr
            LEFT JOIN 
                role r 
            ON 
                r.id = mr.role_id
            WHERE 
                m.id = mr.menu_id
            AND 
                mr.role_id
            IN (
                SELECT 
                    role_id
                FROM 
                    admin_role ar
                WHERE 
                    ar.admin_id = {$userId}
            )
            AND
            mr.role_id = {$roleId}
            ;";

        $model = new Model_MenuRole();
        return $model->queryAll($sql);
    }

    /**
     * 更新角色资源
     *
     * @param int $roleId
     * @param array $mids
     * @return bool
     */
    public function updatePermiss($roleId, $mids)
    {
        try {
            $model = new Model_MenuRole();
            $model->deleteByParams(['role_id' => $roleId]);
            if (is_array($mids) and count($mids) > 0) {
                foreach ($mids as $mid) {
                    $model->insert(['menu_id' => $mid, 'role_id' => $roleId]);
                }
            }
        } catch (Exception $e) {
            DI()->logger->debug(DI()->request->getService() . 'error,', print_r($e->getMessage()));
            throw new MTS_ZException('跟新失败');
        }
        return true;
    }
}
