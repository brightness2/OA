<!--
 * @Author: Brightness
 * @Date: 2021-03-12 10:33:02
 * @LastEditors: Brightness
 * @LastEditTime: 2021-03-31 11:33:17
 * @Description:  
-->
<template>
  <div id="sys-base">
        <el-tabs type="card" v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="部门管理" name="DepMana">
                <dep-mana></dep-mana>
            </el-tab-pane>
            <el-tab-pane label="职位管理" name="PosMana">
                <pos-mana></pos-mana>
            </el-tab-pane>
            <el-tab-pane label="职称管理" name="JoblevelMana">
                <joblevel-mana></joblevel-mana>
            </el-tab-pane>
            <!-- <el-tab-pane label="奖惩规则" name="EcMana">
                <ec-mana></ec-mana>
            </el-tab-pane> -->
            <el-tab-pane label="权限组" name="PermissMana">
                <permiss-mana></permiss-mana>
            </el-tab-pane>

        </el-tabs>
  </div>
</template>

<script>
import DepMana from '@/components/Sys/Base/DepMana'
import PosMana from '@/components/Sys/Base/PosMana'
import JoblevelMana from '@/components/Sys/Base/JoblevelMana'
// import EcMana from '@/components/Sys/Base/EcMana'
import PermissMana from '@/components/Sys/Base/PermissMana'


export default {
    name:'SysBase',
    data () {
        return {
            activeName:'DepMana',
        }
    },
    methods:{
        handleClick:()=>{

        }
    },
    components:{
        DepMana,
        PosMana,
        JoblevelMana,
        // EcMana,
        PermissMana,
    }
}
</script>

<style lang="less" scoped>
#sys-base{

}
</style>