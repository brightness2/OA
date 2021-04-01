<template>
  <div id="sys-admin">
      <div class="form">
          <el-input
            placeholder="通过用户名搜索用户..."
            prefix-icon="el-icon-search"
            v-model="keywords"
            class="input"
            @keydown.enter.native="search"
          >
          </el-input>
          <el-button type="primary" icon="el-icon-search" @click="search">搜索</el-button>
      </div>

      <div class="admins-box">
        <el-card class="admin-card" 
        v-for="(admin,index) in admins"
        :key="index"
        >
            <div slot="header" class="clearfix">
                <span>{{admin.name}}</span>
                <el-button 
                class="delete-admin-btn" 
                type="text"
                 icon="el-icon-delete"
                 @click="deleteAdmin(admin)"
                 >
                 </el-button>
            </div>
            <div class="admin-content">
                <div class="image">
                    <img :src="admin.avatar" :alt="admin.name">
                </div>
                <div class="user-info">
                    <div class="item">
                        <span class="label">用户名:</span>
                        <span class="value">{{admin.username}}</span>
                    </div>
                    <div class="item">
                        <span class="label">手机号码:</span>
                        <span class="value">{{admin.phone}}</span>
                    </div>
                    <div class="item">
                        <span class="label">地址:</span>
                        <span class="value">{{admin.address}}</span>
                    </div>
                    <div class="item">
                        <span class="label">用户状态:</span>
                        <el-switch
                            v-model="admin.enabled"
                            active-color="#13ce66"
                            inactive-color="#ff4949"
                            active-text="启用"
                            inactive-text="禁用"
                            active-value="1"
                            inactive-value="0"
                            @change="enableChange(admin)"
                        >
                        </el-switch>
                    </div>
                </div>
                <div class="roles">
                    <span class="label">用户角色:</span>
                    <span class="value">
                        <el-tag 
                            type="success"
                            v-for="(role,index) in admin.roles"
                            :key="index"
                            class="role"
                        >
                            {{role.name_zh}}
                        </el-tag>
                        <el-popover
                            placement="right"
                            title="角色列表"
                            width="200"
                            trigger="click"
                            @show="showPop(admin)"
                            @hide="hidePop(admin)"
                        >
                            <el-select
                                v-model="selectRoles"
                                multiple
                                placeholder="请选择角色"
                            >
                                <el-option
                                    v-for="(r,idx) in allRoles"
                                    :key="idx"
                                    :label="r.name_zh"
                                    :value="r.id"
                                >
                                </el-option>
                            </el-select>
                            <el-button type="text" slot="reference" icon="el-icon-more"></el-button>
                        </el-popover>
                    </span>
                    
                </div>
                <div class="remake">
                    <span class="label">备注:</span>
                    <span class="value">
                        {{admin.remark}}
                    </span>
                </div>
            </div>
        </el-card>
      </div>
  </div>
</template>

<script>
export default {
    name:'SysAdmin',
    data () {
        return {
            admins:[],
            keywords:'',
            allRoles:[],
            selectRoles:[],
        }
    },
    methods:{
        initAdmins(keywords = null){
            this.getRequest('SysAdmin.getList',{sp:{adminName:keywords}}).then(res => {
                if(res){
                    this.admins = res;
                }
            });
        },
        initAllRoles(){
            this.getRequest('Console.getRoles').then(res => {
                if(res){
                   
                    this.allRoles = res;
                }
            });
        },
        search(){
            this.initAdmins(this.keywords);
        },
        deleteAdmin(admin){
            this.$confirm('此操作将永久删除 ['+admin.name+'] 操作员, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning',
            }).then(() => {
                this.postRequest('SysAdmin.delete',{id:admin.id}).then(res => {
                    if(res){
                        this.initAdmins();
                    }
                });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消操作'
                });
            });
      
           
        },
        enableChange(admin){
            this.postRequest('SysAdmin.setEnabled',{id:admin.id,enabled:admin.enabled}).then(res => {
                if(res){
                    this.$message.success('切换成功');
                }
            });
        },
        showPop(admin){
            this.initAllRoles();
            let roles = admin.roles;
            this.selectRoles = [];
            roles.forEach(r => {
                this.selectRoles.push(r.role_id);
            });
        },
        hidePop(admin){
            //判断角色是否变更
            let roles = [];
            Object.assign(roles,admin.roles);
            let flag =false;
            if(roles.length != this.selectRoles.length){
                flag = true;
            }else {
                for(let i=0;i<roles.length;i++){
                    let r = roles[i];
                    for(let j=0;j<this.selectRoles.length;j++){
                       let srId = this.selectRoles[j];
                       if(r.role_id == srId){
                           roles.splice(i,1);
                           i--;
                           break;
                       }
                    }
                }
                if(roles.length != 0){
                    flag = true;
                }
            }

            //请求接口，修改角色
            if(flag){
                this.postRequest('SysAdmin.setRoles',{id:admin.id,rids:this.selectRoles}).then(res => {
                    if(res){
                        this.initAdmins();
                        this.$message.success('更新成功');
                    }
                });
            }
            
        },
    },
    created(){
        this.initAdmins();
       
    },
}
</script>

<style lang="less">
#sys-admin{
    .form{
        display: flex;
        width: 40%;
        margin: 20px auto;
        .input{
            margin-right: 20px;
        }
    }
    .admins-box{
        display: flex;
        flex-wrap: wrap;
        
        .admin-card{
            width: 32%;
            margin-right: 10px;
            margin-bottom: 20px;

            .delete-admin-btn{
                float: right; 
                padding: 3px 0;
                color:#ff0000;
                font-size:20px;
            }

            .admin-content{
                .image{
                    width: 72px;
                    height: 72px;
                   margin: 0 auto;
                    img{
                        width: 100%;
                        height: 100%;
                        border-radius: 100%;
                    }
                }
                
                .user-info{
                    
                    font-size: 14px;
                    color: var(--primary-color);
                    .item{
                        margin-bottom: 10px;
                        
                        .label{
                            display: inline-block;
                            width: 60px;
                            margin-right: 10px;
                            text-align: right;
                            color: var(--light-text-color);
                        }
                        .value{
                            text-align: right;
                        }
                    }
                }
                .roles{
                    font-size: 14px;
                    color: var(--primary-color);
                    .label{
                        color: var(--light-text-color);
                        margin-right: 10px;
                    }
                    .value{
                        .role{
                        margin-right: 10px;
                    }
                    }
                    
                }

                .remake{
                    margin-top: 20px;
                    font-size: 12px;
                    color: var(--desc-text-color);
                }
            }
        }
    }
    
}
</style>