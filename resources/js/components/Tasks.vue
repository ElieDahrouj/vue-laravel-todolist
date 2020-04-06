<template>
    <div class="container d-flex flex-wrap justify-content-center">
        <div v-for="task in tasks" :key="task.id" class="card m-2" style="width: 18rem;">
            <div class="card-body d-flex flex-column justify-content-between">
                <p class="card-text">{{task.description}}</p>
                <div class="d-flex justify-content-start">
                    <router-link v-bind:to="'/hello/'+task.id"><button class="btn btn-dark rounded mr-2">More</button></router-link>
                    <router-link v-bind:to="'/tasks/'+task.id+'/edit'"><button class="btn btn-light rounded mr-2">Update</button></router-link>
                    <button @click="deleteTask(task.id)" class="btn btn-danger rounded">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name:'Tasks',
        data(){
            return {
                tasks:[]
            }
        },
        methods:{
            deleteTask(param){
                axios.delete('/api/tasks/'+param)
                    .then(res=>{
                        this.tasks.forEach(task => {
                            if (task.id === param) {
                                this.tasks.splice(this.tasks.indexOf(task), 1)
                            }
                        })
                    })
            }
        },
        mounted() {
            axios.get('http://127.0.0.1:8000/api/tasks')
                .then(res=>{
                    this.tasks = res.data
                })
        }
    }
</script>
