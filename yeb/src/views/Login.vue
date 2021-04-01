<template>
  <div id="login">
      <el-form class="login-form" 
            v-loading="loading"
            element-loading-text="正在登录..."
            element-loading-spinner="el-icon-loading"
            element-loading-background="rgba(0, 0, 0, 0.8)"
            ref="loginForm" 
            :rules="loginRules"
            :model="loginForm">
            <h1 class="form-title">系统登陆</h1>
            <el-form-item prop="username" >
                <el-input v-model="loginForm.username" @keydown.enter.native="loginSubmit('loginForm')" auto-complate="false" placeholder="请输入用户名"></el-input>
            </el-form-item>
            <el-form-item prop="password">
                <el-input type="password" @keydown.enter.native="loginSubmit('loginForm')" auto-complate="false"  v-model="loginForm.password" placeholder="请输入密码"></el-input>
            </el-form-item>
            <el-form-item class="code-item" prop="code">
                <div class="code-box">
                      <el-input class="code-input" @keydown.enter.native="loginSubmit('loginForm')" v-model="loginForm.code"  auto-complate="false" placeholder="点击图片更换验证码"></el-input>
                      <div class="code-image">
                          <img :src="captchUrl" @click="getCaptcha" >
                      </div>
                </div>
              
            </el-form-item>
            
            <el-form-item>
                 <el-checkbox v-model="checked">记住我</el-checkbox>
                <el-button class="submit-btn" type="primary"  @click="loginSubmit('loginForm')">登录</el-button>
            </el-form-item>
            
      </el-form>
  </div>
</template>

<script>
export default {
    name:'Login',
    data () {
        return {
            //验证码图片路径
            captchUrl:'',
            // 登录表单信息
            loginForm:{
                username:'admin',
                password:'123456',
                code:'1234'
            },
            //记住我勾选
            checked:true,
            //校验规则
            loginRules:{
                username: [
                    { required: true, message: '请输入用户名', trigger: 'blur' },
                ],
                password: [
                    { required: true, message: '请输入密码', trigger: 'blur' },
                ],
                code: [
                    { required: true, message: '请输入验证码', trigger: 'blur' },
                ],
            },
            //加载状态
            loading:false
        }
    },
    methods:{
        //登录按钮
        loginSubmit(formName){
            this.$refs[formName].validate((valid) => {
                if(valid){
                    this.loading = true;
                    this.postRequest('Login.login',this.loginForm).then(res => {
                        
                        this.loading = false;
                        if(res){
                            
                            this.$message.success({message:'登录成功'});
                            // 存储用户token
                            window.sessionStorage.setItem('tokenStr',res.token);
                            //跳转首页
                            // this.$router.replace({path:'/home'});
                            let redirectPath =  this.$route.query.redirect;
                            
                            this.$router.replace({path:(redirectPath == '/'
                            ||redirectPath == undefined)?'/home':redirectPath});
                        }

                    });
                }else{
                    console.log(valid);
                    this.$message({
                        message: '请填写完整登录信息',
                        type: 'error'
                    });
                    return false;
                }
            });

        },
        getCaptcha(){
            
            this.captchUrl = this.baseUrl+'/OA/Public/index.php?service=Login.GetCaptcha&time='+new Date().getTime();
           
        }
        
    },
    computed:{
         baseUrl(){
              if(process.env.NODE_ENV == 'dev'){
                  return '/api';
              }else{
                  return 'http://192.168.174.129';
              }
        }
    },
    created:function () {
       this.captchUrl = this.baseUrl+'/OA/Public/index.php?service=Login.GetCaptcha';
    }
   
}
</script>

<style lang="less" scoped>
#login{
    width:100%;
    height: 80vh;
    min-width: 300px;
    display: flex;
    justify-content: center;
    align-items: center;

    .login-form{
        width: 30%;
        min-width: 200px;
        padding: 40px;
        border: 1px solid var(--border-color);
        box-shadow: 0.8px 1px 8px var(--border-color);
    }

    .form-title{
        text-align: center;
    }

    .code-box{
        display: flex;
        justify-content: space-between;
        .code-input{
            width: 50%;
        }
        .code-image{
            width: 30%;
            background: red;
            img{
                width: 100%;
                height: 100%;
            }
        }
    }
    .submit-btn{
        display: block;
        width: 100%;
    }
}

</style>