/*
 * @Author: Brightness
 * @Date: 2021-03-09 10:24:15
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 16:36:18
 * @Description:  
 */
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
// 插件形式使用请求
import { postRequest } from './utils/api.js';
import { getRequest } from './utils/api.js';
import { initMenu } from './utils/menu';
import { INIT_ADMIN } from './store/actionTypes';



Vue.config.productionTip = false
Vue.use(ElementUI,{size:'small'});
Vue.prototype.postRequest = postRequest;
Vue.prototype.getRequest = getRequest;

// 全局路由前置守卫
router.beforeEach((to, from, next) => {
 let t = sessionStorage.getItem('tokenStr');
  if(t){
    /*已登录*/
    //初始化菜单
    initMenu(router,store);
    //判断是否有user信息
    if(!sessionStorage.getItem('user')){
      getRequest('User.getUser',{token:t}).then(res => {
            if(res){
              sessionStorage.setItem('user',JSON.stringify(res));
              store.dispatch(INIT_ADMIN,res);
            }else{
              ElementUI.Message.warning({message:'用户信息获取失败！'});
              next('/');
            }
      });
    }
    next();
  }else{
    
    /* 没有登录，跳转登录页 */
    if(to.path == '/'){
      next();
    }else{
      ElementUI.Message.warning({message:'请先登录!'});
      next('/?redirect='+to.path);
    }
    
  }
  
});

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
