<template>
  <div id="dep-mana">
    <div class="box">
          <el-input
            placeholder="输入部门名称进行搜索"
            v-model="filterText"
            prefix-icon="el-icon-search"
            class="filter-input"
            >
          </el-input>

          <el-tree
            class="filter-tree"
            :data="deps"
            :props="defaultProps"
            :filter-node-method="filterNode"
            :expand-on-click-node="false"
            ref="tree">
              <span class="custom-tree-node" slot-scope="{ node, data }">
                <span>{{ node.label }}</span>
                <span>
                  <el-button
                    type="primary"
                    size="mini"
                    class="dep-btn"
                    @click="() => showAddDep(data)">
                    添加部门
                  </el-button>
                  <el-button
                    type="danger"
                    size="mini"
                    class="dep-btn"
                    @click="() => deleteDep(data)">
                    删除部门
                  </el-button>
                </span>
              </span>
          </el-tree>
    </div>
    
    <el-dialog
      title="添加部门"
      :visible.sync="dialogVisible"
      width="30%"
      >
      <div>
        <table>
          <tr>
            <td>
              <el-tag>上级部门</el-tag>
            </td>
            <td>
              {{pname}}
            </td>
          </tr>
          <tr>
            <td>
              <el-tag>部门名称</el-tag>
            </td>
            <td>
              <el-input
              size="small"
                v-model="dep.name"
                placeholder="请输入部门名称..."
                @keydown.enter.native="addDep"
              >
              </el-input>
            </td>
          </tr>
        </table>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="addDep">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
export default {
  name:'DepMana',
  data () {
    return {
      filterText: '',
      deps:[],
      defaultProps: {
        children: 'children',
        label: 'name'
      },
      dialogVisible:false,
      dep:{
        name:'',
        parent_id:0,
      },
      pname:'',
    }
  },
  watch: {
    filterText(val) {
      this.$refs.tree.filter(val);
    }
  },
  methods: {
    filterNode(value, data) {
      if (!value) return true;
      return data.name.indexOf(value) !== -1;
    },
    initDeps(){
      this.getRequest('SysBase.getDepTree').then(res => {
        if(res){
          this.deps = res;
        }
      })
    },
    initDep(){
       this.dep = {
          name:'',
          parent_id:0
        }
        this.pname = '';
    },
    showAddDep(data){
      this.pname = data.name;
      this.dep.parent_id = data.id;
      this.dialogVisible = true;

    },
    deleteDep(data){
      if(0 != data.is_parent){
        this.$message.error('存在子部门，无法删除,或刷新重试');
        return;
      }
       this.$confirm('此操作将永久删除 ['+data.name+'] 部门, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
      }).then(() => {
        
          this.postRequest('SysBase.deleteDep',{id:data.id}).then(res => {
            if(res){
              this.deleteDepFromDeps(null,this.deps,data.id);
              this.$message.success('删除成功');  
            }
          });
      });
    },
    addDep(){
      if(this.dep.name && this.dep.parent_id){
       
        let obj = {
          name:this.dep.name,
          parent_id:this.dep.parent_id,
          is_parent:0
        }
        this.postRequest('SysBase.addDep',obj).then(res => {
          if(res){
              obj.id = res;
              this.$message.success('新增成功');
              this.initDep();
              this.addDep2Deps(this.deps,obj);
              this.dialogVisible = false;
          }
        });
       
      }else{
        this.$message.error('请填写部门名称');
      }
      
    },
    addDep2Deps(deps,obj){

        for(let i = 0; i < deps.length; i++){
          let d = deps[i];
          d.children = d.children?d.children:[];
          if(d.id == obj.parent_id){
            d.children = d.children.concat(obj);
            if(d.children.length > 0){
              d.is_parent = 1;
            }
            return;
          }else{
            this.addDep2Deps(d.children,obj);
          }
        }
    },
    deleteDepFromDeps(p,deps,id){
      deps = deps?deps:[];
      for(let i=0;i<deps.length;i++){
        let d = deps[i];
        if(d.id == id){
          deps.splice(i,1);
          if(p && p.children.length == 0){
            p.is_parent = 0;
          }
          return;
        }else{
          this.deleteDepFromDeps(d,d.children,id);
        }
      }
    },
  },
  created(){
    this.initDeps();
  },
}
</script>

<style lang="less" scoped>
#dep-mana{
  .box{
    width: 500px;

    .filter-input{
      margin-bottom: 10px;
    }
    .custom-tree-node{
      display: flex;
      justify-content: space-between;
      width: 100%;
      .dep-btn{
        padding: 2px;
      }
    }
    
  }
}

</style>
<style lang="less">
  .el-tree-node__content:hover {
      background-color:var(--border-color);
  }
</style>