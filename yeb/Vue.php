<?php
/*
 * @Author: Brightness
 * @Date: 2020-10-19 14:59:53
 * @LastEditors: Brightness
 * @LastEditTime: 2021-01-25 10:26:28
 * @Description: 测试接口
 */

class Api_Vue extends PhalApi_Api {
    
    public function getRules()
    {
        // $tokenRules = DI()->config->get('app.apiCommonRules.token');
        // $tokenRules['require'] = false;
        return array(
            // '*'=>array(
            //     'token'=>$tokenRules,
            // ),
            'getRoutes'=>array(),
            'login'=>array(),
            'getUser'=>array(
                'token'=>['name'=>'token'],

            ),
            'logout'=>array(),
            'sysSetting'=>array(),
            'getPositions'=>array(),
            'addPosition'=>array(
                'data'=>['name'=>'pos','type'=>'array','format'=>'json',
                'require'=>true,'desc'=>'职位信息'],
            ),
            'deletePosition'=>array(
                'id'=>['name'=>'id','require'=>true,'desc'=>'职位编号'],
            ),
            'editPosition'=>array(
                'data'=>['name'=>'pos','type'=>'array','format'=>'json',
                'require'=>true,'desc'=>'职位信息'],
                'id'=>['name'=>'id','require'=>true,'desc'=>'职位编号'],
            ),
            'deletePositions'=>array(
                'ids'=>['name'=>'ids','type'=>'array','require'=>true,'desc'=>'职位编号数组'],
            ),
            'getRoles'=>array(),
            'getMenus'=>array(),
            'getPermiss'=>array(
                'roleId'=>['name'=>'roleId','require'=>true,'desc'=>'角色ID'],
            ),
            'updatePermiss'=>array(
                'roleId'=>['name'=>'roleId','require'=>true,'desc'=>'角色ID'],
                'permissIds'=>['name'=>'mids','require'=>true,'type'=>'array',
                'format'=>'json','desc'=>'权限菜单ID'],
            ),
            'getDepartments'=>array(),
            'getAdmins'=>array(),
            'getEmps'=>array(),
        );
       
    }
   
    public  function getRoutes()
    {
        /*
         
         */
        $routes = [
            [
                //完整的菜单结构
             "id"=>1,//ID
             "url"=>"/",//url
             "path"=>"/",//path
             "name"=>"Login",//菜单名
             "component"=>"Login",//组件
             "iconCls"=>"",//菜单图标
             "keepAlive"=>null,//是否保持激活
             "requireAuth"=>false,//是否需要认证
             "parentId"=>1,//父级ID
             "enable"=>false,//是否启用
             "children"=>null,//子菜单
             "roles"=>null,//角色列表
            ],
            [
             "id"=>2,
             "path"=>"/home",
             "name"=>"导航一",
             "component"=>"Home",
             "iconCls"=>"el-icon-location",
             "enable"=>true,
             "children"=>[
                [
                    "path"=>"/test",
                    "name"=>"选项一",
                    "component"=>"Test",
                    "enable"=>true,
                ],
                [
                    "path"=>"/test2",
                    "name"=>"选项二",
                    "component"=>"Test2",
                    "enable"=>true,
                ]
             ]
            ],
            [
             "id"=>3,//ID
             "url"=>"/home",//url
             "path"=>"/home",//path
             "name"=>"员工资料",//菜单名
             "component"=>"Home",//组件
             "iconCls"=>"el-icon-location",//菜单图标
             "keepAlive"=>null,//是否保持激活
             "requireAuth"=>false,//是否需要认证
             "enable"=>true,//是否启用
             "children"=>[
                    [
                        "path"=>"/emp/empBase",
                        "name"=>"基本资料",
                        "component"=>"Emp/EmpBase",
                        "enable"=>true,
                    ],
                    
                    
                ],//子菜单
            
            ],
            [
             "id"=>4,//ID
             "url"=>"/home",//url
             "path"=>"/home",//path
             "name"=>"系统管理",//菜单名
             "component"=>"Home",//组件
             "iconCls"=>"el-icon-location",//菜单图标
             "keepAlive"=>null,//是否保持激活
             "requireAuth"=>false,//是否需要认证
             "enable"=>true,//是否启用
             "children"=>[
                [
                    "path"=>"/sys/sysBase",
                    "name"=>"基础设置",
                    "component"=>"Sys/SysBase",
                    "enable"=>true,
                ],
                [
                    "path"=>"/sys/admin",
                    "name"=>"操作员管理",
                    "component"=>"Sys/SysAdmin",
                    "enable"=>true,
                ],
                
             ],//子菜单
            
            ],
         
        ];
       return $routes;
    }

    public function login()
    {
        $token = 'dfdjfhdjjd3564545';
        return $token;

    } 

    public function getUser()
    {
        
        if(!$this->token){
            return false;
        }
        $user = [
            "id"=>1,
            "relaname"=>"系统管理员",
            "phone"=>"18xxxxxxxxx",
            "address"=>"",
            "enable"=>true,
            "username"=>"admin",
            "userFace"=>"http://192.168.174.129/images/admin4.jpg",//头像
            "remake"=>"",
            "roles"=>[
                [
                    "id"=>1,
                    "name"=>"role_admin",
                    "name_zh"=>"系统管理员"
                ]
            ],
            "locked"=>true,
        ];
        return $user;
    }

    public function logout()
    {
        return "注销成功";
    }

    public function sysSetting()
    {
        return 'sysSetting';
    }

    public function getPositions()
    {
        $positions = [
            [
                'id'=>1,
                'name'=>'admin',
                'createTime'=>'2021-03-11',
                'enable'=>true,
                'titleLevel'=>'初级',
            ],
            [
                'id'=>2,
                'name'=>'Brightness',
                'createTime'=>'2021-03-12',
                'enable'=>false,
                'titleLevel'=>'正高级',
            ],
        ];
        return $positions;
    }

    public function addPosition()
    {
        return $this->data;
    }

    public function deletePosition()
    {
        return '删除成功';
    }

    public function editPosition()
    {
        return $this->data;
    }

    public function deletePositions()
    {
        return $this->ids;
    }

    public function getRoles()
    {
        $roles = [
            [
                "id"=>1,
                "name"=>"ROLE_manager",
                "nameZh"=>"部门经理"
            ],
            [
                "id"=>2,
                "name"=>"ROLE_personnel",
                "nameZh"=>"人事专员"
            ],
            [
                "id"=>3,
                "name"=>"ROLE_recruiter",
                "nameZh"=>"招聘主管"
            ],
            [
                "id"=>4,
                "name"=>"ROLE_admin",
                "nameZh"=>"系统管理员"
            ],
        ];

        return $roles;
    }

    public function getMenus()
    {
        $menus =array(
            [
                "id"=>1,
                "url"=>"",
                "path"=>"",
                "name"=>"所有",
                "parentId"=>null,
                "enable"=>true,
                "children"=>[
                    [
                        "id"=>2,
                        "url"=>"",
                        "path"=>"",
                        "name"=>"员工资料",
                        "parentId"=>null,
                        "enable"=>true,
                        "children"=>[
                            [
                                "id"=>7,
                                "url"=>"",
                                "path"=>"",
                                "name"=>"基本资料",
                                "parentId"=>null,
                                "enable"=>true,
                            ],
                            [
                                "id"=>8,
                                "url"=>"",
                                "path"=>"",
                                "name"=>"高级资料",
                                "parentId"=>null,
                                "enable"=>true,
                            ],
                        ],
                    ],
                    [
                        "id"=>3,
                        "url"=>"",
                        "path"=>"",
                        "name"=>"人事管理",
                        "parentId"=>null,
                        "enable"=>true,
                        "children"=>[
                            [
                                "id"=>9,
                                "url"=>"",
                                "path"=>"",
                                "name"=>"员工资料",
                                "parentId"=>null,
                                "enable"=>true,
                            ],
                            [
                                "id"=>10,
                                "url"=>"",
                                "path"=>"",
                                "name"=>"员工奖惩",
                                "parentId"=>null,
                                "enable"=>true,
                            ],
                            [
                                "id"=>11,
                                "url"=>"",
                                "path"=>"",
                                "name"=>"员工培训",
                                "parentId"=>null,
                                "enable"=>true,
                            ],
                            [
                                "id"=>12,
                                "url"=>"",
                                "path"=>"",
                                "name"=>"员工调动",
                                "parentId"=>null,
                                "enable"=>true,
                            ],
                           
                        ],
                    ],
                ],
                
            ],
        );

        return $menus;
    }

    public function getPermiss()
    {
        if($this->roleId == 1)
        {
            return [7,8,9,10,11];
        }else if ($this->roleId == 2) 
        {
            return [11,12];
        }
        else {
            return null;
        }
    }

    public function updatePermiss()
    {
       return 'roleID:'.$this->roleId.'--new permiss:'.json_encode($this->permissIds);
    }

    public  function getDepartments()
    {
        $departments = array(
            [
                "id"=>1,
                "name"=>"股东会",
                "parentId"=>-1,
                "depPath"=>'.1',
                "enable"=>true,
                "isParent"=>true,
                "children"=>[
                    [
                        "id"=>2,
                        "name"=>"董事会",
                        "parentId"=>1,
                        "depPath"=>'.1.2',
                        "enable"=>true,
                        "isParent"=>true,
                        "children"=>[
                            [
                                "id"=>3,
                                "name"=>"总办",
                                "parentId"=>2,
                                "depPath"=>'.1.2.3',
                                "enable"=>true,
                                "isParent"=>true,
                                "children"=>[
                                    [
                                        "id"=>4,
                                        "name"=>"财务部",
                                        "parentId"=>3,
                                        "depPath"=>'.1.2.3.4',
                                        "enable"=>true,
                                        "isParent"=>false,
                                        "children"=>[],
                                    ],
                                    [
                                        "id"=>5,
                                        "name"=>"市场部",
                                        "parentId"=>3,
                                        "depPath"=>'.1.2.3.5',
                                        "enable"=>true,
                                        "isParent"=>true,
                                        "children"=>[
                                          [
                                            "id"=>6,
                                            "name"=>"华东市场部",
                                            "parentId"=>5,
                                            "depPath"=>'.1.2.3.5.6',
                                            "enable"=>true,
                                            "isParent"=>true,
                                            "children"=>[
                                                [
                                                    "id"=>8,
                                                    "name"=>"上海市场部",
                                                    "parentId"=>6,
                                                    "depPath"=>'.1.2.3.5.6.8',
                                                    "enable"=>true,
                                                    "isParent"=>false,
                                                    "children"=>[]
                                                ],
                                            ],
                                          ], 
                                          [
                                            "id"=>7,
                                            "name"=>"华南市场部",
                                            "parentId"=>5,
                                            "depPath"=>'.1.2.3.5.7',
                                            "enable"=>true,
                                            "isParent"=>false,
                                            "children"=>[],
                                          ], 
                                          [
                                            "id"=>9,
                                            "name"=>"西北市场部",
                                            "parentId"=>5,
                                            "depPath"=>'.1.2.3.5.9',
                                            "enable"=>true,
                                            "isParent"=>true,
                                            "children"=>[
                                                [
                                                    "id"=>10,
                                                    "name"=>"贵阳市场部",
                                                    "parentId"=>9,
                                                    "depPath"=>'.1.2.3.5.9.10',
                                                    "enable"=>true,
                                                    "isParent"=>true,
                                                    "children"=>[
                                                        [
                                                            "id"=>11,
                                                            "name"=>"乌当区市场部",
                                                            "parentId"=>10,
                                                            "depPath"=>'.1.2.3.5.9.10.11',
                                                            "enable"=>true,
                                                            "isParent"=>false,
                                                            "children"=>[],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                          ],  
                                        ],
                                    ],
                                    [
                                        "id"=>12,
                                        "name"=>"技术部",
                                        "parentId"=>3,
                                        "depPath"=>'.1.2.3.12',
                                        "enable"=>true,
                                        "isParent"=>false,
                                        "children"=>[],
                                    ],
                                    [
                                        "id"=>13,
                                        "name"=>"运维部",
                                        "parentId"=>3,
                                        "depPath"=>'.1.2.3.13',
                                        "enable"=>true,
                                        "isParent"=>false,
                                        "children"=>[],
                                    ],
                                   
                                ],
                            ],
                            
                        ],
                    ],
                   
                ],
            ]
        );

        return $departments;
    }

    public function getAdmins()
    {
        $admins = [
            [
                "id"=>1,
                "name"=>"亮",
                "phone"=>"182xxxxxxx",
                "address"=>"住址1",
                "enable"=>true,
                "username"=>"Brightness",
                "password"=>"md5加密",
                "remark"=>'备注内容',
                "userFace"=>"http://192.168.174.129/images/admin1.jpg",
                "roles"=>[
                    [
                        "id"=>1,
                        "name"=>"ROLE_manager",
                        "nameZh"=>"部门经理",
                    ],
                    [
                        "id"=>3,
                        "name"=>"ROLE_recruiter",
                        "nameZh"=>"招聘主管",
                    ],
                   
                ],
                "authorities"=>[
                    [
                        "authority"=>"ROLE_manager"
                    ],
                    [
                        "authority"=>"ROLE_recruiter"
                    ],
                ],
                "accountNotLocked"=>true,
                "accountNotExpired"=>true,
                "credentialsNotExpired"=>true,
            ],
            [
                "id"=>2,
                "name"=>"招聘",
                "phone"=>"182xxxxxxx",
                "address"=>"住址2",
                "enable"=>true,
                "username"=>"zhaoPing",
                "password"=>"md5加密",
                "remark"=>null,
                "userFace"=>"http://192.168.174.129/images/admin2.jpg",
                "roles"=>[
                    
                    [
                        "id"=>3,
                        "name"=>"ROLE_recruiter",
                        "nameZh"=>"招聘主管",
                    ],
                   
                ],
                "authorities"=>[
                   
                    [
                        "authority"=>"ROLE_recruiter"
                    ],
                ],
                "accountNotLocked"=>true,
                "accountNotExpired"=>true,
                "credentialsNotExpired"=>true,
            ],
            [
                "id"=>3,
                "name"=>"人事",
                "phone"=>"182xxxxxxx",
                "address"=>"住址3",
                "enable"=>true,
                "username"=>"renShi",
                "password"=>"md5加密",
                "remark"=>null,
                "userFace"=>"http://192.168.174.129/images/admin3.jpg",
                "roles"=>[
                    
                    [
                        "id"=>2,
                        "name"=>"ROLE_personnel",
                        "nameZh"=>"人事专员",
                    ],
                   
                ],
                "authorities"=>[
                   
                    [
                        "authority"=>"ROLE_personnel"
                    ],
                ],
                "accountNotLocked"=>true,
                "accountNotExpired"=>true,
                "credentialsNotExpired"=>true,
            ],
            [
                "id"=>4,
                "name"=>"系统管理员",
                "phone"=>"182xxxxxxx",
                "address"=>null,
                "enable"=>true,
                "username"=>"admin",
                "password"=>"md5加密",
                "remark"=>null,
                "userFace"=>"http://192.168.174.129/images/admin4.jpg",
                "roles"=>[
                    
                    [
                        "id"=>4,
                        "name"=>"ROLE_admin",
                        "nameZh"=>"系统管理员",
                    ],
                   
                ],
                "authorities"=>[
                   
                    [
                        "authority"=>"ROLE_admin"
                    ],
                ],
                "accountNotLocked"=>true,
                "accountNotExpired"=>true,
                "credentialsNotExpired"=>true,
            ],
            [
                "id"=>5,
                "name"=>"系统管理员2",
                "phone"=>"182xxxxxxx",
                "address"=>null,
                "enable"=>true,
                "username"=>"admin2",
                "password"=>"md5加密",
                "remark"=>null,
                "userFace"=>"http://192.168.174.129/images/admin4.jpg",
                "roles"=>[
                    
                    [
                        "id"=>4,
                        "name"=>"ROLE_admin",
                        "nameZh"=>"系统管理员",
                    ],
                   
                ],
                "authorities"=>[
                   
                    [
                        "authority"=>"ROLE_admin"
                    ],
                ],
                "accountNotLocked"=>true,
                "accountNotExpired"=>true,
                "credentialsNotExpired"=>true,
            ],
        ];

        return $admins;
    }

    public function getEmps()
    {
        $emps = [
            [
                "id"=>1,
                "name"=>"张三",
                "gender"=>"男",
                "birthday"=>"2020-03-16",
                "idCard"=>"441298544862685487",
                "wedlock"=>"未婚",
                "nationId"=>1,
                "nativePlace"=>"英市",
                "politicId"=>11,  
                "email"=>"23@qq.com",
                "phone" => "1621944xxxx",
                "address" => "测试地址",
                "department_id" => 4 ,
                "job_level_id" => 1 ,
                "pos_id" => 1 ,
                "engage_form" => "劳务合同" ,
                "tiptop_degree" => "本科" ,
                "specialty" => "计算机" ,
                "school" => "中大" ,
                "begin_date" => "2020-03-11" ,
                "work_state" => "试用期" ,
                "work_id" => "2" ,
                "contract_term" => "1" ,
                "conversion_time" => "2020-05-11" ,
                "not_work_date" => null ,
                "begin_contract" => "2020-03-11" ,
                "end_contract" => "2020-05-11" ,
                "work_age" => '1' ,
                "salary_id" => 1,
            ],
            [
                "id"=>2,
                "name"=>"李四",
                "gender"=>"女",
                "birthday"=>"2020-03-16",
                "idCard"=>"441298544862685487",
                "wedlock"=>"未婚",
                "nationId"=>1,
                "nativePlace"=>"英市",
                "politiId"=>11,  
                "email"=>"23@qq.com",
                "phone" => "1621944xxxx",
                "address" => "测试地址",
                "department_id" => 4 ,
                "job_level_id" => 1 ,
                "pos_id" => 1 ,
                "engage_form" => "劳务合同" ,
                "tiptop_degree" => "本科" ,
                "specialty" => "计算机" ,
                "school" => "中大" ,
                "begin_date" => "2020-03-11" ,
                "work_state" => "试用期" ,
                "work_id" => "2" ,
                "contract_term" => "1" ,
                "conversion_time" => "2020-05-11" ,
                "not_work_date" => null ,
                "begin_contract" => "2020-03-11" ,
                "end_contract" => "2020-05-11" ,
                "work_age" => '1' ,
                "salary_id" => 1,
            ],
            [
                "id"=>3,
                "name"=>"王五",
                "gender"=>"男",
                "birthday"=>"2020-03-16",
                "idCard"=>"441298544862685487",
                "wedlock"=>"未婚",
                "nationId"=>1,
                "nativePlace"=>"英市",
                "politiId"=>11,  
                "email"=>"23@qq.com",
                "phone" => "1621944xxxx",
                "address" => "测试地址",
                "department_id" => 4 ,
                "job_level_id" => 1 ,
                "pos_id" => 1 ,
                "engage_form" => "劳务合同" ,
                "tiptop_degree" => "本科" ,
                "specialty" => "计算机" ,
                "school" => "中大" ,
                "begin_date" => "2020-03-11" ,
                "work_state" => "试用期" ,
                "work_id" => "2" ,
                "contract_term" => "1" ,
                "conversion_time" => "2020-05-11" ,
                "not_work_date" => null ,
                "begin_contract" => "2020-03-11" ,
                "end_contract" => "2020-05-11" ,
                "work_age" => '1' ,
                "salary_id" => 1,
            ],

        ];
        return [
            "data"=>$emps,
            "total"=>count($emps),
        ] ;
    }
}

?>