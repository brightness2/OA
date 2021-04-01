/*
 * @Author: Brightness
 * @Date: 2021-03-10 16:43:21
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 17:18:13
 * @Description:  
 */
import { INIT_ADMIN, INIT_ROUTES } from "./actionTypes";

export default {
    [INIT_ROUTES](state,routes){
        state.routes = routes;
    },
    [INIT_ADMIN](state,admin){
        state.currentAdmin = admin;
        window.sessionStorage.setItem('user',JSON.stringify(admin));
    }
   
}