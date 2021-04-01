<template>
  <div id="permiss-mana">
      <div class="form">
        <!-- <el-input size="small" 
        placeholder="请输入角色英文名"
        v-model="role.name"
        class="input"
        @keydown.enter.native="addRole"
        >
          <template slot="prepend">ROLE_</template>
        </el-input> -->
        <el-input 
        size="small" 
        placeholder="请输入角色中文名"
        v-model="role.name_zh"
        class="input"
        @keydown.enter.native="addRole"
        ></el-input>
        <el-button
          size="small"
          type="primary"
          icon="el-icon-plus"
          @click="addRole"
        >添加角色</el-button>
      </div>

      <div class="permiss-main">

        <el-collapse v-model="activeName" accordion @change="change">
          <el-collapse-item 
          :title="r.name_zh"
           :name="r.id" 
           v-for="(r,index) in roles"
           :key="index"
           >
           
            <el-card class="box-card">
              <div slot="header" class="clearfix">
                <span>可访问资源</span>
                <el-button size="small"
                 class="delete-role-btn"
                  type="text" 
                  icon="el-icon-delete"
                  @click="deleteRole(r)"
                  >
                  </el-button>
              </div>
              <div class="card-body">
                  <el-tree 
                  :data="allMenus" 
                  :props="defaultProps" 
                  show-checkbox
                  :default-checked-keys="selectMenus"
                  node-key="id"
                  ref="tree"
                  :key="index"
                  >
                  </el-tree>
                  <div class="btn-group">
                    <el-button size="mini" @click="cancelUpdate">取消修改</el-button>
                    <el-button size="mini" type="primary" @click="doUpdate(r.id,index)">确认修改</el-button>
                  </div>
                 
              </div>
            </el-card>
            
          </el-collapse-item>
         
          
        </el-collapse>
      </div>
  </div>
</template>

<script>
export default {
    name:'PermissMana',
    data(){
      return {
        role:{
          // name:'',
          name_zh:''
        },
        roles:[],
        allMenus:[],
        defaultProps: {
          children: 'children',
          label: 'name'
        },
        selectMenus:[],
        activeName:null

      }
    },
    methods:{
      initRoles(){
        this.getRequest('SysBase.getRoleList').then(res => {
          if(res){
            this.roles = res;
          }
        });
        
      },
      initAllMenus(){
        this.getRequest('SysBase.getMenuList').then(res => {
          if(res){
            this.allMenus = res;
          }
        });
      },
      initSelectMenus(rid){
        this.getRequest('SysBase.getPermiss',{rid:rid}).then(res => {

          if(res){
            this.selectMenus = res;
          }
        });
      },
      change(id){
        this.selectMenus = [];
        
        if(id){
          this.initAllMenus();
          this.initSelectMenus(id);
        }
      },
      doUpdate(id,index){
        let selectKeys = [];
        // this.$refs.tree  标签上定义的 ref
        let tree = this.$refs.tree[index];
        let leafChecked = tree.getCheckedKeys(false);
        let halfChecked = tree.getHalfCheckedKeys();
        selectKeys = [...leafChecked,...halfChecked];
        this.postRequest('SysBase.updatePermiss',{rid:id,
        mids:JSON.stringify(selectKeys)}).then(res => {
          if(res){
            this.activeName = null;
            this.$message.success('更新成功');
          }
        });
      },
      cancelUpdate(){
        this.activeName = null;
      },
      addRole(){
        if(this.role.name_zh){
          this.activeName = null;
          this.postRequest('SysBase.addRole',{name:this.role.name_zh}).then(res => {
            if(res){
              this.initRoles();
              this.role = {
                // name:'',
                name_zh:''
              };
              this.$message.success({message:'添加成功'});
            }
          });
          
        }else{
          this.$message.error({message:'请填写角色名'});
        }
      },
      deleteRole(role){
        this.$confirm('此操作将永久删除 ['+role.name_zh+'] 角色, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
        }).then(() => {
              this.postRequest('SysBase.deleteRole',{id:role.id}).then(res => {
                if(res){
                  this.activeName = null;
                  this.initRoles();
                }
              });

        }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消操作'
                });          
        });
        
      }
    },
    created(){
      this.initRoles();

    }

}
</script>

<style lang="less" scope>
#permiss-mana{
    .form{
      display: flex;
      margin-bottom: 30px;
      .input{
        width: 300px;
        margin-right: 20px;
      }
    }

    .permiss-main{
      .box-card{
          .delete-role-btn{
            float: right;
            font-size: 22px;
            color: #ff0000;
          }
          .btn-group{
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
          }
      } 
     
    
    }
}
 
</style>