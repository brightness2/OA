<template>
  <div id="pos-mana">

      <!-- 表单 -->
      <div class="form">
         <el-input
          placeholder="添加职位"
          suffix-icon="el-icon-plus"
          size="small"
          class="add-pos-input"
          v-model="pos.name"
          @keydown.enter.native="addPos"
          >
        </el-input>
        <el-button icon="el-icon-plus" size="small" type="primary" @click="addPos" >添加职位</el-button>
      </div>
      
      <!-- 表格 -->
      <div class="table">
          <el-table
            stripe
            border
            :data="positions"
            @selection-change="handleSelectionChange"
            class="pos-table">
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
              label="职位"
              width="180">
            </el-table-column>
            <el-table-column
              prop="create_date"
              label="创建时间"
              width="180">
            </el-table-column>
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
      <el-dialog class="edit-position-dialog" title="编辑职位" :visible.sync="dialogVisible">
        <div class="edit-position-form">
          <el-tag class="label">职位名称</el-tag>
          <el-input class="input" @keydown.enter.native="doUpdate" size="small" v-model="updatePos.name" placeholder="请填写职位名称"></el-input>
        </div>
        <div slot="footer" class="dialog-footer">
          <el-button size="small" @click="dialogVisible = false">取 消</el-button>
          <el-button size="small" type="primary" @click="doUpdate">确 定</el-button>
        </div>
      </el-dialog>
  </div>
</template>

<script>
export default {
    name:'PosMana',
    data () {
      return {
        pos:{
          name:''
        },
        updatePos:{
          name:''
        },
        positions: [],
        dialogVisible:false,
        multipleSelection:[],
      };
    },
    methods:{
      // 添加职位
      addPos(){
        if(this.pos.name){
          this.postRequest('SysBase.addPos',this.pos).then(res => {
            if(res){
              // 刷新表格
              this.initPositions();
              this.pos.name = '';
              this.$message.success({message:'添加成功'});

           }
          });
           
        }else{
          this.$message.error({message:'职位名称不能为空！'});
        }
      },
      //初始化职位表格
      initPositions(){
        this.getRequest('SysBase.getPosList').then(res => {
          if(res){
            this.positions = res;
          }
        });
      },
      //打开编辑框
      editViewShow(index, row) {
        this.dialogVisible = true;  
        Object.assign(this.updatePos,row);
      },
      //删除职位
      deletePosition(index, row) {
        console.log(index, row);
        this.$confirm('此操作将永久删除 ['+row.name+'] 职位, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
        }).then(() => {
                this.postRequest('SysBase.deletePos',{id:row.id}).then(res => {
                    if(res){
                       this.initPositions();
                    }
                });
        }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消操作'
                });          
        });
      },
      //更新职位
      doUpdate(){
     
        this.postRequest('SysBase.editPos',{id:this.updatePos.id,name:this.updatePos.name})
        .then(res => {
          if(res){
            // 刷新表格
            this.initPositions();
           
            // 
            this.$message.success({message:'更新成功'});
            this.dialogVisible = false;
          }
        });
        
      },
      //表格勾选
      handleSelectionChange(val) {
        this.multipleSelection = val;
        
      },
      //批量删除
      deleteMany(){
        this.$confirm('此操作将永久删除 ['+this.multipleSelection.length+'] 条职位, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
        }).then(() => {
                let ids = [];
                this.multipleSelection.forEach(pos => {
                  ids.push(pos.id);
                });

                this.postRequest('SysBase.deleteMorePos',{ids:ids}).then(res => {
                    if(res){
                       this.initPositions();
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
    //生命周期-创建
    created(){
      this.initPositions();
    },
    
}
</script>

<style lang="less" scoped>
#pos-mana{
  .form{
    .add-pos-input{
      width: 300px;
      margin-right: 10px;
      margin-bottom: 20px;
    }
  }

  .table{
    margin-bottom: 10px;
    .pos-table{
      width: fit-content;
    }
  }

  .delete-more{
    margin-bottom: 10px;
  }

  .edit-position-dialog{
    .edit-position-form{
        display: flex;
        .label{
          margin-right: 20px;
        }
        .input{
          width: 400px;
        }
    }
  }
  
}
</style>