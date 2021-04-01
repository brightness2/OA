<template>
  <div id="home">
    <el-container>
        <el-header class="home-header">
           
                <div class="title">
                    云E办
                </div>
                <el-dropdown @command="userHandel">
                    <span class="el-dropdown-link">
                        {{user.username}}
                        <i>
                            <img class="user-face" :src="user.avatar">
                        </i>
                    </span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command="adminInfo">个人中心</el-dropdown-item>
                        <el-dropdown-item command="setting">设置</el-dropdown-item>
                        <el-dropdown-item command="logout">注销登录</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
        </el-header>
        <el-container>
            <el-aside width="200px">
                <el-menu router>
                    <div v-for="(item,index) in routes" :key="index">
                        <el-submenu :index="index+''" v-if="item.enabled">
                            <template slot="title">
                                <i :class="item.iconCls?item.iconCls:''"></i>
                                <span>{{item.name}}</span>
                            </template>
                            <div v-for="(child,idx) in item.children" :key="idx">
                                <el-menu-item  :index="child.path" v-if="child.enabled">
                                    {{child.name}}
                                </el-menu-item>
                            </div>
                        </el-submenu>
                    </div>
                    
                </el-menu>
            </el-aside>
            <el-main>
                <el-breadcrumb separator-class="el-icon-arrow-right" 
                    v-if="this.$router.currentRoute.path != '/home'">
                    <el-breadcrumb-item :to="{ path: '/home' }">首页</el-breadcrumb-item>
                    <el-breadcrumb-item>{{this.$router.currentRoute.name}}</el-breadcrumb-item>
                </el-breadcrumb>
                <div class="home-welcom" v-if="this.$router.currentRoute.path == '/home'">
                   <div class="title">欢迎来到云E办</div> 
                </div>
                <router-view class="home-router-view"/>
            </el-main>
        </el-container>
    </el-container>
  </div>
</template>

<script>

export default {
    name:'Home',
    data () {
        return {
        }
    },
    computed:{
        routes(){
            return this.$store.state.routes;
        },
        user(){
            return this.$store.state.currentAdmin;
        }
    },
    methods:{
        userHandel(command){
            switch (command) {
                case 'logout':
                    this.$confirm('此操作将退出系统, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                            this.postRequest('Login.logout').then(res => {
                                if(res){
                                    sessionStorage.clear();
                                    this.$message.success({message:res});
                                    this.$store.dispatch('initRoutes',[]);
                                    this.$router.push('/');
                                    window.location.reload();
                                }
                            });
                    }).catch(() => {
                            this.$message({
                                type: 'info',
                                message: '已取消'
                            });          
                    });
                   
                    break;
                case 'adminInfo':
                        this.$router.push('/adminInfo');
                    break;
                default:
                    break;
            }
        }
    }
    
    
}
</script>

<style lang="less" scoped>
#home{
    .home-header{
        background: var(--primary-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        box-sizing: border-box;

        .title{
            font-size: 2rem;
            color: #fff;
        }
        .user-face{
            width: 48px;
            height: 48px;
            border-radius: 100%;
        }
    }
    .home-welcom{
        .title{
            text-align: center;
            font-size: 30px;
            color: var(--primary-color);
        }
    }

    .home-router-view{
        margin-top: 20px;
    }
    
}
</style>