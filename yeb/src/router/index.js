/*
 * @Author: Brightness
 * @Date: 2021-03-09 10:24:15
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 14:40:11
 * @Description:  
 */
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
 {
   path:'/',
   name:'Login',
   component:()=>import('@/views/Login.vue')
 },
 {
   path:'/home',
   name:'Home',
   component:()=>import('@/views/Home.vue'),
   children:[
      {
        path:'/adminInfo',
        name:'个人中心',
        component:()=>import('@/views/AdminInfo.vue')
      }
   ]
 }
 
];

const router = new VueRouter({
  routes
})

export default router
