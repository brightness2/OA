<template>
  <div id="emp-base">
      <div class="form">
          <el-input 
          prefix-icon="el-icon-search"
          placeholder="请输入员工名称进行搜索..."
          class="input"
          v-model="empName"
          @keydown.enter.native="initEmps"
          clearable
          @clear="initEmps"
          >
          </el-input>
          <el-button class="btn" type="primary" icon="el-icon-search" @click="initEmps">搜索</el-button>
          <!-- <el-button class="btn" icon="el-icon-caret-bottom">高级搜索</el-button> -->
      </div>

      <div class="tools">
          <!-- <el-button class="btn" type="success" icon="el-icon-top">导入数据</el-button>
          <el-button class="btn" type="success" icon="el-icon-bottom">导出数据</el-button> -->
          <el-button class="btn" type="primary" icon="el-icon-plus" @click="showAddPop">添加员工</el-button>
      </div>

      <div class="table">
        <el-table
            :data="emps"
            stripe
            border
            v-loading="loading"
            element-loading-text="拼命加载中..."
            element-loading-icon="el-icon-loading"
            element-loading-background="rgba(0,0,0,0.8)"
            style="width: 100%">
            <el-table-column
                type="selection"
                width="55">
            </el-table-column>
            <el-table-column
                prop="id"
                label="员工ID"
                fixed="left"
                width="60">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="90">
            </el-table-column>
            <el-table-column
                prop="address"
                label="地址">
            </el-table-column>
            <el-table-column
                prop="work_id"
                width="60"
                label="工号">
            </el-table-column>
            <el-table-column
                width="100"
                label="合同期限">
                <template slot-scope="scope">
                    <el-tag>{{scope.row.contract_term}}</el-tag><span> 年</span>
                </template>
            </el-table-column>
            <el-table-column
                fixed="right"
                width="258"
                label="操作">
                <template slot-scope="scope">
                    <el-button size="mini" @click="showEditPop(scope.row)">编辑</el-button>
                    <!-- <el-button size="mini" type="primary">查看高级资料</el-button> -->
                    <el-button size="mini" type="danger" @click="deleteEmp(scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="pager">
            <el-pagination
                background
                layout="sizes, prev, pager, next, jumper, ->, total"
                :total="total"
                @current-change="currentChange"
                @size-change="sizeChange"
            >
            </el-pagination>
        </div>
       
      </div>
      <div class="dialog">
            <el-dialog
                :title="dialogTitle"
                :visible.sync="dialogVisible"
                width="80%"
                :close-on-click-modal="false"
                >
                <div class="content">
                    <el-form :model="emp" ref="empForm">
                        <el-row>
                            <el-col :span="6">
                                <el-form-item class="item" label="姓名:" prop="name">
                                    <el-input size="mini" class="input"
                                    v-model="emp.name" 
                                    prefix-icon="el-icon-edit"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="性别:" prop="gender">
                                    <el-radio-group v-model="emp.gender">
                                        <el-radio class="radio-input" label="男">男</el-radio>
                                        <el-radio class="radio-input" label="女">女</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="出生日期:" prop="birthday">
                                   <el-date-picker
                                    size="mini" 
                                    class="date-input" 
                                    type="date" 
                                    value-format="yyyy-mm-dd"
                                    placeholder="出生日期"
                                    v-model="emp.birthday">
                                    </el-date-picker>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="政治面貌:" prop="politic_id">
                                    <el-select 
                                    size="mini"
                                    class="select-input" 
                                    placeholder="请选择"
                                    v-model="emp.politic_id">
                                        <el-option
                                        v-for="(item,index) in options"
                                        :key="index"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="6">
                                <el-form-item class="item" label="民族:" prop="nation_id">
                                    <el-select 
                                    size="mini"
                                    class="select-input" 
                                    placeholder="请选择"
                                    v-model="emp.nation_id">
                                        <el-option
                                        v-for="(item,index) in options"
                                        :key="index"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="籍贯:" prop="native_place">
                                    <el-input size="mini" class="input"
                                    v-model="emp.native_place" 
                                    prefix-icon="el-icon-edit"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="电子邮件:" prop="email">
                                    <el-input size="mini" class="input"
                                    v-model="emp.email" 
                                    prefix-icon="el-icon-message"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="联系地址:" prop="address">
                                    <el-input size="mini" class="input"
                                    v-model="emp.address" 
                                    prefix-icon="el-icon-location"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="6">
                                <el-form-item class="item" label="职位:" prop="pos_id">
                                    <el-select 
                                    size="mini"
                                    class="select-input" 
                                    placeholder="请选择"
                                    v-model="emp.pos_id">
                                        <el-option
                                        v-for="(item,index) in options"
                                        :key="index"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="职称:" prop="job_level_id">
                                    <el-select 
                                    size="mini"
                                    class="select-input" 
                                    placeholder="请选择"
                                    v-model="emp.job_level_id">
                                        <el-option
                                        v-for="(item,index) in options"
                                        :key="index"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="所属部门:" prop="department_id">
                                    <el-input size="mini" class="input"
                                    v-model="emp.department_id" 
                                    prefix-icon="el-icon-edit"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="电话号码:" prop="phone">
                                    <el-input size="mini" class="input"
                                    v-model="emp.phone" 
                                    prefix-icon="el-icon-phone"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="6">
                                <el-form-item class="item" label="工号:" prop="work_id">
                                    <el-input size="mini" class="input"
                                    v-model="emp.work_id" 
                                    prefix-icon="el-icon-edit"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="学历:" prop="tiptop_degree">
                                   <el-select 
                                    size="mini"
                                    class="select-input" 
                                    placeholder="请选择"
                                    v-model="emp.tiptop_degree">
                                        <el-option
                                        v-for="(item,index) in options"
                                        :key="index"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                             <el-col :span="6">
                                <el-form-item class="item" label="毕业院校:" prop="school">
                                    <el-input size="mini" class="input"
                                    v-model="emp.school" 
                                    prefix-icon="el-icon-edit"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                             <el-col :span="6">
                                <el-form-item class="item" label="专业名称:" prop="specialty">
                                    <el-input size="mini" class="input"
                                    v-model="emp.specialty" 
                                    prefix-icon="el-icon-edit"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="6">
                                <el-form-item class="item" label="入职日期:" prop="begin_date">
                                    <el-date-picker
                                    size="mini" 
                                    class="date-input" 
                                    type="date" 
                                    value-format="yyyy-mm-dd"
                                    placeholder="入职日期"
                                    v-model="emp.begin_date">
                                    </el-date-picker>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="转正日期:" prop="conversion_time">
                                    <el-date-picker
                                    size="mini" 
                                    class="date-input" 
                                    type="date" 
                                    value-format="yyyy-mm-dd"
                                    placeholder="转正日期"
                                    v-model="emp.conversion_time">
                                    </el-date-picker>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="合同起始日期:" prop="begin_contract">
                                    <el-date-picker
                                    size="mini" 
                                    class="date-input" 
                                    type="date" 
                                    value-format="yyyy-mm-dd"
                                    placeholder="合同起始日期"
                                    v-model="emp.begin_contract">
                                    </el-date-picker>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6">
                                <el-form-item class="item" label="合同截止日期:" prop="en_contract">
                                    <el-date-picker
                                    size="mini" 
                                    class="date-input" 
                                    type="date" 
                                    value-format="yyyy-mm-dd"
                                    placeholder="合同截止日期"
                                    v-model="emp.begin_contract">
                                    </el-date-picker>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <hr class="row-line">
                        <el-row>
                            <el-col :span="8">
                                <el-form-item class="item" label="身份证号码:" prop="id_card">
                                    <el-input size="mini" class="input"
                                    style="width:220px;"
                                    v-model="emp.id_card" 
                                    prefix-icon="el-icon-edit"
                                    placeholder="请输入...">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="8">
                                <el-form-item class="item" label="聘用形式:" prop="engage_form">
                                    <el-radio-group v-model="emp.engage_form">
                                        <el-radio class="radio-input" label="劳务合同">劳务合同</el-radio>
                                        <el-radio class="radio-input" label="劳务派遣">劳务派遣</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </el-col>
                            <el-col :span="8">
                                <el-form-item class="item" label="婚姻状况:" prop="wedlock">
                                    <el-radio-group v-model="emp.wedlock">
                                        <el-radio class="radio-input" label="已婚">已婚</el-radio>
                                        <el-radio class="radio-input" label="未婚">未婚</el-radio>
                                        <el-radio class="radio-input" label="离异">离异</el-radio>

                                    </el-radio-group>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </el-form>
                    
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisible = false">取 消</el-button>
                    <el-button type="primary" @click="editEmp" v-if="emp.id">确认修改</el-button>
                    <el-button type="primary" @click="addEmp" v-else>添  加</el-button>

                </span>
            </el-dialog>
      </div>
      
  </div>
</template>

<script>
export default {
    name:'EmpBase',
    data () {
        return {
            emps:[],
            loading:false,
            total:0,
            currentPage:1,
            size:10,
            empName:'',
            dialogVisible:false,
            emp:{},
            options:[
                {
                    label:'一',
                    value:1
                },
                {
                    label:'二',
                    value:2
                }
            ],
            dialogTitle:'添加员工',
        }
    },
    methods:{
        initEmps(){
            this.loading = true;
            this.getRequest('Employee.getList',{page:this.currentPage-1,limit:this.size
            ,sp:{EmpName:this.empName}}).then(res => {
                this.loading = false;
                if(res){
                    this.total = res.length;
                    this.emps = res;
                }
            });
        },
        currentChange(currentPage){
            this.currentPage =currentPage;
            this.initEmps();
        },
        sizeChange(size){
            this.size = size;
            this.initEmps();
        },
        deleteEmp(row){
            this.$confirm('此操作将永久删除 ['+row.name+'] 员工, 是否继续?', '提示', {
                            confirmButtonText: '确定',
                            cancelButtonText: '取消',
                            type: 'warning'
            }).then(() => {
                this.postRequest('Employee.delete',{id:row.id}).then(res => {
                    if(res){
                        this.initEmps();
                        this.$message.success('删除成功');
                    }
                });
            }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消操作'
                    });          
            });
        },
         showAddPop(){
            this.emp = {
                name:'',
                gender:'',
                birthday:'',
                id_card:'',
                wedlock:'',
                nation_id:null,
                native_place:'',
                politic_id:null,  
                email:'',
                phone:'',
                address:'',
                department_id:null ,
                job_level_id:null ,
                pos_id:null ,
                engage_form:'' ,
                tiptop_degree:'' ,
                specialty:'' ,
                school:'' ,
                begin_date:'' ,
                work_state:'' ,
                work_id:'' ,
                contract_term:'' ,
                conversion_time:'' ,
                not_work_date:null ,
                begin_contract:'' ,
                end_contract:'' ,
                work_age:'' ,
                salary_id:null,
            };
            this.dialogVisible = true;
        },
        showEditPop(row){
            this.dialogTitle = "编辑员工";
            this.dialogVisible = true;
            this.emp = row;
        },
        addEmp(){
            this.postRequest('Employee.add',{data:JSON.stringify(this.emp)}).then(res => {
                if(res){
                    this.dialogVisible = false;
                    this.initEmps();
                    this.$message.success('添加成功');
                }
            })
        },
        editEmp(){
            this.postRequest('Employee.edit',{id:this.emp.id,data:JSON.stringify(this.emp)}).then(res => {
                if(res){
                    this.dialogVisible = false;
                    this.initEmps();
                    this.$message.success('更新成功');
                }
            });
        }
    },
    created(){
        this.initEmps();
    },
}
</script>

<style lang="less">
#emp-base{
    .form{
        display: flex;
        width: 50%;
        .input{
            margin-right: 10px;
        }
        .btn{
            margin-right: 10px;
        }
    }

    .tools{
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
    }

    .pager{
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }

    .dialog{
        .content{
            .item{
                .input,.select-input,.date-input{
                    width: 150px;
                }
                .radio-input{
                    margin-right: 30px;
                }
               .el-form-item__label{
                   width: 100px;
               }
            }
            .row-line{
                border-color: rgba(255, 255, 0, 0.1);
            }
        }
    }
}
</style>