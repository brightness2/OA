
module.exports = {
  publicPath: '',
  devServer: { 
    proxy: { 
          '/api': { 
              // 此处的写法，目的是为了 将 /api 替换成 自己的域名路径 
              target: 'http://192.168.174.129',//自己的域名路径
              // 允许跨域 
              changeOrigin: true, 
              ws: true, 
              pathRewrite: { 
                  '^/api': ' ' 
              } 
          } 
      },
    
  } 
}