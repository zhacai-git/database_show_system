<template>
  <div class="container-wrapper">
  <el-row :gutter="20">

    <el-col :span="10">
<!--      <h5>语句1：求全体学生的学号、姓名和出生年份。</h5>-->
<!--      <el-button type="primary" @click="queryAction('select Sno,Sname,(2021-Sage) Birth from student;')" size="medium">点击执行</el-button>-->
<!--      <h5>语句2：求每个系的学生总人数并按降序排列。</h5>-->
<!--      <el-button type="primary" @click="queryAction('select Sdept, count(*) as numbers from student group by Sdept order by count(*) desc;')" size="medium">点击执行</el-button>-->
<!--      <h5>语句3：求选修了课程号为002或003的学生的学号、课程名和成绩。</h5>-->
<!--      <el-button type="primary" size="medium" @click="queryAction('select Sno,Cno,Grade from score where Cno = \'002\' or Cno = \'003\';')">点击执行</el-button>-->
<!--      <h5>语句4：检索选修某课程的学生人数多于3人的教师姓名。</h5>-->
<!--      <el-button type="primary" size="medium" @click="queryAction('select Tname from teacher where Cno = some (select Cno from score group by Cno having count(*) >3);')">点击执行</el-button>-->
<!--      <el-radio v-model="sql" ></el-radio>-->
      <el-radio-group v-model="sql" class="radioGroup">
        <el-radio :label="'select Sno,Sname,(2021-Sage) Birth from student;'">语句1：求全体学生的学号、姓名和出生年份。</el-radio>
        <el-radio :label="'select Sdept, count(*) as numbers from student group by Sdept order by count(*) desc;'">语句2：求每个系的学生总人数并按降序排列。</el-radio>
        <el-radio :label="'select Sno,Cno,Grade from score where Cno = \'002\' or Cno = \'003\';'">语句3：求选修了课程号为002或003的学生的学号、课程名和成绩。</el-radio>
        <el-radio :label="'select Tname from teacher where Cno = some (select Cno from score group by Cno having count(*) >3);'">语句4：检索选修某课程的学生人数多于3人的教师姓名。</el-radio>
        <el-radio :label="'select Sname,Sdept from student where Sno not in (select Sno from score);'">语句5：查询所有未选课程的学生姓名和所在系。</el-radio>
        <el-radio :label="'select student.Sname,s2.Cno,s2.Grade from student,(select max(Grade) Grade,Cno,Sno from score group by Sno) s2 where student.Sno = s2.Sno;'">语句6：求每个同学的课程成绩的最高分，查询结果项包括：学生姓名、课程号及最高分。</el-radio>
        <el-radio :label="'select Tname from teacher where teacher.Cno = (select Cno from course where Cname = \' 数据结构\');'">语句7：求所有讲授数据结构课程的教师姓名。</el-radio>
        <el-radio :label="'select * from student where student.Sno = some (select Sno from score where score.Cno = (select Cno from teacher where Tname = \'李正科\')) and student.Sdept = (select Tdept from teacher where Tname = \'李正科\');'">语句8：查询所有选修了李正科老师的课程的学生信息</el-radio>
<!--        <el-radio :label="'wuhu'">语句9 新建一个关系表S1(SNO,SNAME,SD,SA)，其字段类型<br>定义与Student表中的相应字段(SNO,SNAME,SDEPT,SAGE)的数据类型定义相同。<br>将表Student中在计算机系‘CS’的学生数据插入到表S1中。</el-radio>-->
<!--        <el-radio :label=""></el-radio>-->
<!--        <el-radio :label=""></el-radio>-->
<!--        <el-radio :label=""></el-radio>-->
<!--        <el-radio :label=""></el-radio>-->
<!--        <el-radio :label=""></el-radio>-->
<!--        <el-radio :label=""></el-radio>-->
      </el-radio-group>
      <el-button type="primary" size="medium" @click="queryAction">点击执行选中语句</el-button>
      <div class="phase2">
        <p>语句9 新建一个关系表S1(SNO,SNAME,SD,SA)，其字段类型定义与Student表中的相应字段(SNO,SNAME,SDEPT,SAGE)的数据类型定义相同。将表Student中在计算机系‘CS’的学生数据插入到表S1中。</p>
        <el-button type="primary" size="medium" @click="specialOP9">点击执行</el-button>
        <p>语句10 建立计算机系的学生的视图STUDENT_CS。利用视图STUDENT_CS，将所有学生的001号课程的成绩提高5分。</p>
        <el-button type="primary" size="medium" @click="specialOP10BF">点击查看score表</el-button>
        <el-button type="primary" size="medium" @click="specialOP10">点击执行</el-button>
        <p>语句11 新开一门课，课程信息为： 课程号：010，课程名称：微信小程序	学时	32，学分：2。</p>
        <el-button type="primary" size="medium" @click="checkCourse">点击查看course表</el-button>
        <el-button type="primary" size="medium" @click="specialOP11(1)">点击执行第一条</el-button>
        <p>新增一位教师，教师编号：1110，教师名：王成铜，性别：男，所在系：CS。将“微信小程序”课程分配给王成铜老师。</p>
        <el-button type="primary" size="medium" @click="checkTeacher">点击查看teacher表</el-button>
        <el-button type="primary" size="medium" @click="specialOP11(2)">点击执行第二条</el-button>
        <p>语句12 查找所以带有“成”字的教师信息，并删除，并将删除前后的数据进行对比显示。</p>
        <el-button type="primary" size="medium" @click="specialOP12(1)">查找所以带有“成”字的教师信息</el-button>
        <el-button type="primary" size="medium" @click="specialOP12(2)">删除带有“成”字的教师信息</el-button>
        <el-button type="primary" size="medium" @click="checkTeacher">查看teacher表</el-button>

      </div>
    </el-col>
    <el-col :span="14">
      <h3>运行结果数据区</h3>
      <h4>运行的语句：{{sql_performed}}</h4>
      <el-table
          :data="data"
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
      <h3>后端回传原始数据</h3>
      <p>{{data}}</p>
      <h3 v-if="modifyShowBool">执行过的语句</h3>
      <div class="modifySQLSHOW" v-if="modifyShowBool" v-html="modifyShow">
      </div>
    </el-col>
  </el-row>
  </div>
</template>

<script>
import {sqlQueryRequest,sqlmodifyRequest} from "@/api/sql_interfaces";
import {ElNotification} from "element-plus";
export default {
  name: "standard_demostrate",
  data() {
    return {
      sql: '',
      fields: [],
      data: [],
      sql_request: '',
      query_time:'',
      sql_performed: '',
      modifyShow: '',
      modifyShowBool: false,
      resRaw: []
    }
  },
  methods: {
    queryAction() {
      this.modifyShowBool = false
      sqlQueryRequest(this.sql).then(res => {
        if (res.data.status.success === true) {
          this.fields = res.data.field
          this.data = res.data.content
          this.query_time = res.data.status.query_time
          this.sql_performed = res.data.status.sql_performed
        } else {
          ElNotification({
            title: '查询错误',
            dangerouslyUseHTMLString: true,
            message: '错误信息：'+res.data.status.message+"<br>错误代码："+res.data.status.code,
            type: 'error',
            duration: 0
          })
        }
      })
    },
    modifyAction() {
      sqlmodifyRequest(this.sql).then(res => {
        if (res.data.status.success === true) {
          this.sql_performed = res.data.status.sql_performed
          return true
        } else {
          ElNotification({
            title: '修改错误',
            dangerouslyUseHTMLString: true,
            message: '错误信息：'+res.data.status.message+"<br>错误代码："+res.data.status.code,
            type: 'error',
            duration: 0
          })
          return false
        }
      })
    },
    specialOP9() {
      this.modifyShowBool = true
      this.modifyShow = ''
      this.sql = "create table s1(Sno varchar(50),Sname varchar(50),Sdept varchar(50),Sage int);";
      this.modifyShow = this.modifyShow + this.sql + '<br>'
      if (this.modifyAction()) {
        this.modifyShow = this.modifyShow + '执行成功' +'<br>'
      }
      this.sql = "insert into s1(Sno,Sname,Sdept,Sage) select Sno,Sname,Sdept,Sage from student where Sdept = 'CS';"
      this.modifyShow = this.modifyShow + this.sql + '<br>'
      if (this.modifyAction()) {
        this.modifyShow = this.modifyShow + '执行成功' +'<br>'
      }
      this.sql = "select * from s1;";
      this.queryAction()
    },
    specialOP10BF () {
      this.sql = "select * from score;"
      this.queryAction()
    },
    specialOP10() {
      this.modifyShowBool = true
      this.modifyShow = ''
      this.sql = "create view STUDENT_CS(Sno,Sname,Ssex,Sdept,Sage) as select * from student where Sdept= 'CS';"
      this.modifyShow = this.modifyShow + this.sql + '<br>'
      // this.sql = "select * from score;"
      this.queryAction()
      if (this.modifyAction()) {
        this.modifyShow = this.modifyShow + '执行成功' +'<br>'
      }
      this.sql = "update score set Grade = Grade + 5 where Cno = '001' and Sno = some (select Sno from STUDENT_CS);"
      if (this.modifyAction()) {
        this.modifyShow = this.modifyShow + '执行成功' +'<br>'
      }
      this.sql = "select * from score;"
      this.queryAction()
    },
    specialOP11(phase) {
      this.modifyShowBool = true
      this.modifyShow = ''
      if (phase === 1) {
        this.sql = "insert into course (Cno, Cname, Ctime, Ccredit) VALUES ('010', '微信小程序', 32, 2);"
      } else {
        this.sql = "INSERT INTO teacher (Tno, Tname, Tsex, Cno, Tdept) VALUES ('1110', '王成铜', '男', '010', 'CS');"
      }
      this.modifyAction()
      this.modifyShow = this.modifyShow + this.sql + '<br>'
    },
    specialOP12(phase) {
      this.modifyShow = ''
      if (phase === 1) {
        this.sql = "select * from teacher where Tname like '%成%';"
        this.queryAction()
      } else {
        this.sql = "delete from teacher where Tname like '%成%';"
        this.modifyAction()
      }
    },
    checkCourse() {
      this.sql = "select * from course;"
      this.queryAction()
    },
    checkTeacher() {
      this.sql = "select * from teacher;"
      this.queryAction()
    }
  }
}
</script>

<style scoped>
.container-wrapper {
  margin: 10px 100px 10px 100px;
}
.radioGroup {
  text-align: left;
}
.phase2 {
  text-align: left;
}
</style>
