import axios from 'axios'
import { Message } from 'element-ui'
import  router from '../router'

//响应拦截器
axios.interceptors.response.use(success => {
    // if(success.status && success.status != 200){
    //     console.log('请求出错！');
    // }
    // let res = success.data;
    // if(res.ret != 200){
    //     console.log(res.msg);
    //     return ;
    // }
    // if(res.data.code != 0){
    //     console.log(res.data.errmsg);
    //     return ;
    // }
    // console.log(res.data.result);
   
    if(success.status && success.status == 200){
        let res = success.data;
      
        if(res.ret != 200){
            Message.error({message:res.msg});
            return ;
        }
        if(res.data.code != 0){
            Message.error({message:res.data.errmsg});
            if(res.data.code == 401){
                router.replace('/');
            }else if(res.data.code == 403){
                Message.error({message:'权限不足，请联系管理员！'});
            }
            return ;
        }
        return res.data.result;
    }
},error => {
    let code = error.response.code;
    if(code == 504 || code == 404){
        Message.error({message:'服务器被吃了，囧！'});
    }else if(code == 403){
        Message.error({message:'权限不足，请联系管理员！'});
    }else if(code == 401){
        Message.error({message:'尚未登录，请登录！'});
        router.replace('/');
    }else{
        if(error.response.data.msg){
            Message.error({message:JSON.stringify(error.response.data.msg)});
        }else{
            Message.error({message:'未知错误!'});
        }
    }
    return;
});
// 请求拦截器
axios.interceptors.request.use(config => {
    // console.log(config);
    //有token，则已经登录，携带token，请求时携带token
    let tokenStr = window.sessionStorage.getItem('tokenStr');
    if(tokenStr){
        // config.headers['Authorization'] = tokenStr;
        if(!config.params instanceof Object){
            console.error('axios params must be a object');
            config.params = {};
        }
        config.params = {...config.params,token:tokenStr};
    } 
    return config;
},error => {
    console.log(error);
});

let base_url = '';
if (process.env.NODE_ENV === 'dev'){
    base_url = '/api';
} else {
   base_url = 'http://192.168.174.129';

}

// url前置字符 
const baseUrl = base_url+'/OA/Public/index.php?service=';

// post 请求
export const postRequest = (url,params=null)=>{
    return axios({
        method:'post',
        url:`${baseUrl}${url}`,
        params:params
    })
}
// get 请求
export const getRequest = (url,params)=>{
   
    return axios({
        method:'get',
        url:`${baseUrl}${url}`,
        params:params
    });
}

