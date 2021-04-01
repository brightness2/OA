<template>
  <div id="joblevel-mana">
       <!-- 表单 -->
      <div class="form">
          <el-input
            placeholder="添加职称名称..."
            suffix-icon="el-icon-plus"
            size="small"
            class="input"
            v-model="jl.name"
            @keydown.enter.native="addJobLevel"
          >
          </el-input>
          <el-select v-model="jl.level"
            size="small"
            placeholder="职称等级"
            class="select">
            <el-option
              v-for="item in titleLevels"
              :key="item"
              :label="item"
              :value="item">
            </el-option>
          </el-select>
        <el-button icon="el-icon-plus" size="small" type="primary" @click="addJobLevel" >添加职位</el-button>
      </div>

      <!-- 表格 -->
      <div>
          <el-table
            stripe
            border
            :data="jls"
            @selection-change="handleSelectionChange"
            class="table">
            <el-table-column
              type="selection"
              width="55"
            >
            </el-table-column>
            <el-table-column
              prop="id"
              label="编号"
              width="55">
            </el-table-column>
            <el-table-column
              prop="name"
              label="职称名"
              width="180">
            </el-table-column>
            <el-table-column
              prop="level"
              label="职称等级"
              width="180">
            </el-table-column>
            <el-table-column
              prop="create_date"
              label="创建时间"
              width="180">
            </el-table-column>
            <!-- <el-table-column
              prop="enabled"
              label="是否启用"
              width="100">
              <template slot-scope="scope">
                <el-tag type="success" v-if="scope.row.enabled == 1">已启用</el-tag>
                <el-tag type="danger" v-else>未启用</el-tag>
              </template>
            </el-table-column> -->
            <el-table-column
              label="操作"
              width="146"
            >
                <template slot-scope="scope">
                  <el-button
                    size="mini"
                    @click="editViewShow(scope.$index, scope.row)">编辑</el-button>
                  <el-button
                    size="mini"
                    type="danger"
                    @click="deletePosition(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
          </el-table>
      </div>
      <el-button class="delete-more" size="small" type="danger" 
        :disabled="this.multipleSelection.length == 0" @click="deleteMany">批量删除</el-button>
       <!-- 编辑框 -->
      <el-dialog class="edit-position-dialog" title="编辑职称" :visible.sync="dialogVisible">
        <table>
          <tr>
            <td>
              <el-tag>职称名称</el-tag>
            </td>
            <td>
              <el-input size="small" v-model="updateJl.name" @keydown.enter.native="doUpdate"
               placeholder="职称名称"></el-input>
            </td>
          </tr>

          <tr>
            <td>
              <el-tag>职称等级</el-tag>
            </td>
            <td>
               <el-select v-model="updateJl.level"
                  size="small"
                  placeholder="职称等级"
                  class="select">
                  <el-option
                    v-for="item in titleLevels"
                    :key="item"
                    :label="item"
                    :value="item">
                  </el-option>
                </el-select>
            </td>
          </tr>

          <!-- <tr>
            <td>
              <el-tag>是否启用</el-tag>
            </td>
            <td>
              <el-switch
               v-model="updateJl.enabled"
               active-color="#13ce66"
               inactive-color="#ff4949"
               active-text="已启用"
               inactive-text="未启用"
               active-value="1"
               inactive-value="0"
               >
               </el-switch>
            </td>
          </tr> -->
        </table>
        <div slot="footer" class="dialog-footer">
          <el-button size="small" @click="dialogVisible = false">取 消</el-button>
          <el-button size="small" type="primary" @click="doUpdate">确 定</el-button>
        </div>
      </el-dialog>

  </div>
</template>

<script>
export default {
    name:'JoblevelMana',
    data () {
      return {
        jl:{
          name:'',
          level:''
        },
        updateJl:{
          name:'',
          level:'',
          enabled:0,
        },
        titleLevels:[
          '正高级',
          '副高级',
          '中级',
          '初级',
          '员级',
        ],
        jls:[],
        multipleSelection:[],
        dialogVisible:false,
      }
    },
    methods:{
      initJls(){
        this.getRequest('SysBase.getJobList').then(res => {
          this.jls = res;

        });
        this.jl = {
          name:'',
          titleLevel:''
        };
        
      },
      addJobLevel(){
        if(this.jl.name && this.jl.level){
            this.postRequest('SysBase.addJob',this.jl).then(res => {
              if(res){
                this.$message.success('添加成功');
                this.initJls();

              }
            });
        }else{
          this.$message.error({message:'请填写职称名称与职称等级'});
        }
      },
      editViewShow(index,row){
        this.dialogVisible = true;
        Object.assign(this.updateJl,row);
      },
      deletePosition(index,row){
        this.$confirm('此操作将永久删除 ['+row.name+'] 职称, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
        }).then(() => {
                this.postRequest('SysBase.deleteJob',{id:row.id}).then(res => {
                    if(res){
                        this.initJls();
                    }
                });
        }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消操作'
                });          
        });
      },
      handleSelectionChange(rows){
        this.multipleSelection = rows;
      },
      doUpdate(){
        this.postRequest('SysBase.editJob',this.updateJl).then(res => {
            if(res){
              this.initJls();
              this.dialogVisible = false;
              this.$message.success('更新成功');
            }
        });
      },
      deleteMany(){
        this.$confirm('此操作将永久删除 ['+this.multipleSelection.length+'] 条职称, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
        }).then(() => {
                let ids = [];
                this.multipleSelection.forEach(pos => {
                  ids.push(pos.id);
                });

                this.postRequest('SysBase.deleteMoreJob',{ids:ids}).then(res => {
                    if(res){
                       this.initJls();
                    }
                });

        }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消操作'
                });          
        });
      },
    },
    created(){
      this.initJls();
    }
}
</script>

<style lang="less" scoped>
#joblevel-mana{
  .form{
    .input{
      width: 300px;
      margin-right: 10px;
      margin-bottom: 20px;
    }
    .select{
      margin-right: 10px;
    }

  }

  .table{
    width: fit-content;
  }

  .delete-more{
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .edit-position-dialog{
    table{
      tr{
        td{
          padding-right: 10px;
        }
      }
    }
  }
}
</style>