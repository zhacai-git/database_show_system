<template>
  <h2>SQL查询页面</h2>
  <div class="container-wrapper">
    <el-row >
      <el-col :span="12" :offset="6">
        <el-input type="textarea" v-model="sql_request" placeholder="在此处输入查询语句" :rows="6" class="textarea"></el-input>
      </el-col>
      <el-col :span="6">
        <el-button type="primary" @click="handleSQLQuery" class="submitBtn">提交查询</el-button><br>
      </el-col>
    </el-row>
    <h2 v-if="show">查询结果 时间：{{query_time}}</h2>
    <el-table
        :data="data"
        v-if="show"
    >
      <el-table-column
          label="行"
          prop="index"
      >
      </el-table-column>
      <el-table-column
          :label="fields" v-for="fields in fields"
          :key = fields
          :property="fields"
      >
      </el-table-column>
    </el-table>
    <br>
    <h4>原始数据</h4>
    表头内容:{{fields}}<br>
    表内容：{{data}}
  </div>
</template>

<script>
import {sqlQueryRequest} from "@/api/sql_interfaces";
import {ElNotification} from "element-plus"
export default {
  name: "sql_query_center",
  data() {
    return {
      fields: [],
      data: [],
      sql_request: '',
      query_time:'',
      show: false
    }
  },
  methods: {
    handleSQLQuery() {
      sqlQueryRequest(this.sql_request).then(res => {
        console.log(res)
        if (res.data.status.success === true) {
          this.fields = res.data.field
          this.data = res.data.content
          this.query_time = res.data.status.query_time
          this.show = true
        } else {
          ElNotification({
            title: '查询错误',
            dangerouslyUseHTMLString: true,
            message: '错误信息：'+res.data.status.message+"<br>错误代码："+res.data.status.code,
            type: 'error',
            duration: 0
          })
        }
      }).catch(err => {
        ElNotification({
          title: '查询错误',
          dangerouslyUseHTMLString: true,
          message: '错误信息：'+err.message+"<br>错误代码：1003",
          type: 'error',
          duration: 0
        })
      })
    }
  }
}
</script>

<style scoped>
.container-wrapper {
  margin: 10px 200px 10px 200px;
}

.el-input {
  height: 300px;
  width: 500px;
}

.textarea :deep() .el-textarea__inner{
  font-family:"Microsoft" !important;
  font-size:20px !important;
}
.submitBtn {
  position: relative;
  float: left;
  margin: 70px 0 0 30px ;
}
</style>
