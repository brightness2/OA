<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<style  lang="less">
:root{
  --border-color:#DCDFE6;
  --primary-color:#45a0fc;
  --light-text-color:#666;
  --desc-text-color:#aaa;
}
html,body{
  margin: 0;
  padding: 0;
}
a,ul,li,ol{
  text-decoration: none;
}

.el-collapse-item__header {
   &.is-active{
       color: var(--primary-color);
   }
   &:hover{
     color: var(--primary-color);
   }
 }
</style>
