<!--
 * @Author: Brightness
 * @Date: 2021-03-31 14:30:40
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 18:07:37
 * @Description:  
-->
<template>
  <div id="admin-info">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span>{{admin.name}}</span>
            </div>
            <div>
                <div class="avatar">
                    <img title="点击修改头像" :src="admin.avatar" alt="">
                </div>
                <div class="text-box">
                    <div class="item">
                        <span class="label">电话号码:</span>
                        <el-tag class="value">{{admin.phone}}</el-tag>
                    </div>
                    <div class="item">
                        <span class="label">居住地址:</span>
                        <el-tag class="value">{{admin.address}}</el-tag>
                    </div>
                    <div class="item">
                        <span class="label">用户标签:</span>
                        <el-tag class="value" type="success"
                        v-for="(role,index) in admin.roles" 
                        :key="index"
                        >{{role.name_zh}}</el-tag>
                    </div>
                    
                </div>
                <div class="btn-group">
                    <el-button type="primary" @click="showEditDialog">
                        修改信息
                    </el-button>
                    <el-button type="danger" @click="showPwdDialog">
                        修改密码
                    </el-button>
                </div>
            </div>
        </el-card>
        <el-dialog
            title="编辑用户信息"
            width="32%"
            :visible="editVisible">
            <table>
                <tr>
                    <td>用户昵称:</td>
                    <td>
                        <el-input v-model="updateAdmin.username" @keydown.enter.native="updateInfo"></el-input>
                    </td>
                </tr>
                <tr>
                    <td>电话号码:</td>
                    <td>
                        <el-input v-model="updateAdmin.phone" @keydown.enter.native="updateInfo"></el-input>
                    </td>
                </tr>
                <tr>
                    <td>用户地址:</td>
                    <td>
                        <el-input v-model="updateAdmin.address" @keydown.enter.native="updateInfo"></el-input>
                    </td>
                </tr>
            </table>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="updateInfo">确 定</el-button>
            </span>
        </el-dialog>
         <el-dialog
            title="修改密码"
            width="32%"
            :visible="pwdVisible">
            <el-form
             :model="pwdForm"
             ref="pwdForm"
             :rules="rules"
             status-icon>
                <el-form-item label="旧密码" prop="oldPass">
                    <el-input type="password" v-model="pwdForm.oldPass" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="pass">
                    <el-input type="password" v-model="pwdForm.pass" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item label="确认密码" prop="checkPass">
                    <el-input type="password" v-model="pwdForm.checkPass" autocomplete="off"></el-input>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="submitForm('pwdForm')">确 定</el-button>
            </span>
        </el-dialog>
  </div>
</template>

<script>
export default {
    name:'AdminInfo',
    data () {
        //自定义校验方法
        var validatePass = (rule, value, callback) => {
            if (value === '') {
            callback(new Error('请输入密码'));
            } else {
                if (this.pwdForm.checkPass !== '') {
                    this.$refs.pwdForm.validateField('checkPass');
                }
                callback();
            }
        };
        var validatePass2 = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('请再次输入密码'));
            } else if (value !== this.pwdForm.pass) {
                callback(new Error('两次输入密码不一致!'));
            } else {
                callback();
            }
        };
        var validateOldPass = (rule, value, callback) => {
            if(value === ''){
                callback(new Error('请输入旧密码'));
            }else{
                callback();
            }
        };
        return {
            
            //
            admin:{},
            updateAdmin:{},
            editVisible:false,
            pwdVisible:false,
            pwdForm: {
                pass: '',
                checkPass: '',
                oldPass: ''
            },
            rules: {
                pass: [
                    { validator: validatePass, trigger: 'blur' }
                ],
                checkPass: [
                    { validator: validatePass2, trigger: 'blur' }
                ],
                oldPass:[
                    { validator: validateOldPass, trigger: 'blur' }
                ],
               
            }
        }
    },
    methods:{
        initInfo(){
            this.postRequest('User.getUser').then(res => {
                if(res){
                    this.admin = res;
                    this.updateAdmin =  Object.assign({},this.admin);
                    this.$store.dispatch('initAdmin', this.admin);

                   
                }
            });
        },
        showEditDialog(){
            this.editVisible = true;
         
        },
        showPwdDialog(){
            this.pwdVisible = true;
        },
        updateInfo(){
            this.postRequest('User.editUser',{
                data:{
                    username:this.updateAdmin.username,
                    phone:this.updateAdmin.phone,
                    address:this.updateAdmin.address
                }
                }).then(res => {
               
                if(res){
                    this.initInfo();
                    this.editVisible = false;
                    this.$message.success('更新成功');
                }
            });
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.postRequest('User.updatePassword',this.pwdForm).then(res => {
                        if(res){
                            this.pwdVisible = false;
                            this.$message.success('更新成功');
                        }
                    })
                } else {
                    return false;
                }
            });
        },
    },
    created(){
        this.initInfo();
    },


}
</script>


<style lang="less" scoped>
#admin-info{
    .box-card{
        width:60%;
        margin: 0 auto;

        .avatar{
            width: 100px;
            height: 100px;
            border-radius: 100%;
            margin: 20px auto;
            img{
                width: 100%;
                height: 100%;
                border-radius: 100%;
            }
        }
        .text-box{
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items:center;
            margin-bottom: 20px;
            .item{
                width: 46%;
                margin-bottom: 10px;
                .label{
                    margin-right: 20px;
                }
            }
        }
        .btn-group{
            width: 50%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
        }
    }
}
</style>

