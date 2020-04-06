<template>
    <div class="container d-flex flex-wrap justify-content-center">
        <div v-if="this.task.description" class="card" style="width: 18rem;">
            <div class="card-body d-flex flex-column justify-content-between">
                <p class="card-text">{{task.description}}</p>
            </div>
        </div>
        <div v-else class="alert alert-danger" role="alert">
            <p class="echec">
                {{this.task['0']}}
            </p>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        name:'hello',
        data(){
            return {
                task:[],
            }
        },
        mounted() {
            axios.get('http://127.0.0.1:8000/api/tasks/'+this.$route.params.id)
                .then(res => {
                    this.task = res.data
                })
        }
    }
</script>
<style scoped lang="css">
    .echec{
        font-size: 30px;
        text-align: center;
        margin:0;
    }
</style>