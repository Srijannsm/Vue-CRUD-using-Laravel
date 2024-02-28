<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h3>
          Students Table
          <router-link to="/students/create" class="btn btn-primary float-end">
            Add Student
          </router-link>
        </h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Course</th>
              <th>Email</th>
              <th>Contact No:</th>
              <th>Created At:</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="students.length > 0">
            <tr v-for="(student, index) in students" :key="index">
              <td>{{ student.id }}</td>
              <td>{{ student.name }}</td>
              <td>{{ student.course }}</td>
              <td>{{ student.email }}</td>
              <td>{{ student.phone }}</td>
              <td>{{ formatDate(student.created_at) }}</td>
              <td>
                <router-link :to="{ path: '/students/' + student.id + '/edit' }" class="btn btn-success">
                  Edit
                </router-link>
                <button type="button" class="btn btn-danger" @click="deleteStudent(student.id)">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="7" style="text-align: center">
                LOADING...
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'students',
  data() {
    return {
      students: []
    }
  },
  mounted() {
    this.getStudents()
  },
  methods: {
    getStudents() {
      axios.get('http://127.0.0.1:8000/api/student_details').then(res => {
        this.students = res.data.data
      });
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toISOString().split('T')[0];
    },
    deleteStudent(studentId) {
      if (confirm('Are you sure?')) {
        axios.delete(`http://127.0.0.1:8000/api/student/${studentId}/delete`)
          .then(res => {
            console.log(res)
            alert(res.data.success);
            window.location.reload(); // Reload the page
          })
          .catch(error => {
            console.error('Error deleting student:', error);
            
          });
      }
    }
  }
}
</script>

<style scoped>
.container {
  margin-top: 20px;
  padding: 10px;
  border-radius: 5px;
  overflow: auto;
}

tbody tr td:last-child {
  display: flex;
  justify-content: space-around;
}

.table.table-bordered {
  text-align: center;
}

.table.table-bordered thead th {
  font-weight: bold;
}

.table.table-bordered td,
.table.table-bordered th {
  vertical-align: middle;
}
</style>
