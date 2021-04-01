/*
 * @Author: Brightness
 * @Date: 2021-03-10 16:39:03
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 16:31:14
 * @Description:  
 */
import {  INIT_ADMIN, INIT_ROUTES } from "./actionTypes";

export default {
    [INIT_ROUTES]({ commit,state },routes){
        commit(INIT_ROUTES,routes);
    },
    [INIT_ADMIN]({ commit },admin){
        commit(INIT_ADMIN,admin);
    }
}