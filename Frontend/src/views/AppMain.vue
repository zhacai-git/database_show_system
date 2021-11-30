<template>
  <el-container class="main-container-wrapper">
    <el-header style="height: 70px">
      <h2 class="header_text">数据库原理展示页面</h2>
    </el-header>
    <el-container>
      <el-aside style="width: 200px;height: 1100px">
        <el-menu
          :default-active="$route.name"
          :router="true"
        >
          <el-menu-item index="standard_demo" :route="{path: '/standard_demo'}">
            <span>标准语句演示</span>
          </el-menu-item>
          <el-menu-item index="sql_custom_query" :route="{path: '/sql_custom_query'}">
            <span>SQL自定义查询</span>
          </el-menu-item>
        </el-menu>
      </el-aside>
      <el-main>
        <router-view />
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
export default {
  name: "AppMain",
  mounted() {
    this.$router.push('/standard_demo')
  }
}
</script>

<style scoped>
.main-container-wrapper {
  border-radius: 10px 10px 10px 10px;
  box-shadow: 0 0 40px rgb(0 0 0 / 10%);
  height: 100%;
}

.header_text {
  position: relative;
  float: left;
}

.el-footer {
  background-color: #b3c0d1;
  color: var(--el-text-color-primary);
  text-align: center;
  line-height: 60px;
}

.el-aside {
  background-color: #d3dce6;
  color: var(--el-text-color-primary);
  text-align: center;
  line-height: 200px;
}

body > .el-container {
  margin-bottom: 40px;
}

.el-main {

}
</style>
