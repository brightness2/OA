/*
 * @Author: Brightness
 * @Date: 2021-03-30 09:11:43
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 11:23:12
 * @Description:  
 */
import axios from 'axios';
const service = axios.create(
    {
        responseType:'arraybuffer'
    }
);

service.interceptors.request.use(config=>{
    let tokenStr = window.sessionStorage.getItem('tokenStr');
    if(tokenStr){
        if(!config.params instanceof Object){
            console.error('axios params must be a object');
            config.params = {};
        }
        config.params = {...config.params,token:tokenStr};
    }
    return config;
},
error=>{
    console.log(error);
});

service.interceptors.response.use(success=>{
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
    const headers = success.headers;
    let reg = RegExp('/application\/json/');
    if(headers['content-type'].match(reg)){
        unitToString()
    }
},error=>{
    console.log(error);
});