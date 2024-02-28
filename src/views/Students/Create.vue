<template>
    <div class="container mt-5 w-50">
        <div class="card">
            <div class="card-header">
                <h4>Add Student</h4>
            </div>
            <div class="card-body">
                <ul v-if="Object.keys(this.errorList).length > 0" class="alert alert-warning">
                    <li v-for="(error, index) in this.errorList" :key="index" class="mb-0 ms-3">
                        {{ error[0] }}
                    </li>
                </ul>

                <form @submit.prevent="storeStudent">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" v-model="model.student.name">
                    </div>
                    <div class="mb-3">
                        <label for="course" class="form-label">Course</label>
                        <input type="text" id="course" class="form-control" v-model="model.student.course">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" v-model="model.student.email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Contact No.</label>
                        <input type="number" id="phone" class="form-control" v-model="model.student.phone">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'studentCreate',
    data() {
        return {
            errorList: '',
            model: {
                student: {
                    name: '',
                    course: '',
                    email: '',
                    phone: ''
                }
            }
        }
    },
    methods: {
        storeStudent() {
            var myThis = this;
            axios.post('http://127.0.0.1:8000/api/student/store', this.model.student)
                .then(res => {
                    console.log(res.data)
                    alert(res.data.success)
                    this.model.student = {
                        name: '',
                        course: '',
                        email: '',
                        phone: ''
                    }
                    // Redirect to another route after successful post
                    this.$router.push('/students');
                })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status == 422) {
                            myThis.errorList = error.response.data.error;
                        }
                        // console.log(error.response.data);
                        // console.log(error.response.status);
                        // console.log(error.response.headers);
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
                });
        }
    }
}
</script>
