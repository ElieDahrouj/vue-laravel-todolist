<template>
    <div>
        <form v-if="this.task.description" class="container" style="width:50%">
            <h1>Mise à jour d'une tâche</h1>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control mb-2" id="description" name="description" v-model.trim="$v.description.$model" rows="7">{{this.task.description}}</textarea>
                <button @click="check" type="button" class="btn btn-success">Valider</button>
            </div>
            <div v-if="errors.length">
                <div class="p-3 mb-2 bg-danger text-white rounded"> {{errors[0]}}</div>
            </div>
            <div v-if="success">
                <div class="p-3 mb-2 bg-success text-white rounded">{{this.msgSuccess}}</div>
            </div>
        </form>
        <div v-else class="alert alert-danger" role="alert">
            <p class="echec">
                {{this.task['0']}}
            </p>
        </div>
    </div>
</template>
<script>
    import { required } from 'vuelidate/lib/validators'
    import axios from "axios"
    export default {
        name:"edit",
        data(){
            return {
                errors: [],
                description:null,
                success:false,
                task:[],
                msgSuccess:null
            }
        },
        validations: {
            description: {
                required,
            },
        },
        mounted() {
            axios.get('http://127.0.0.1:8000/api/tasks/'+this.$route.params.id)
                .then(res => {
                    this.task = res.data
                    this.description = res.data.description
                })
        },
        methods:{
            displayAndCheckError(errorArray, titleError) {
                if (errorArray.indexOf(titleError) === -1) {
                    errorArray.push(titleError);
                }
            },
            check(){
                if (this.$v.description.required !==true){
                    this.displayAndCheckError(this.errors,"Description required")
                    this.success = false
                }
                if(this.$v.description.required){
                    axios.put('http://127.0.0.1:8000/api/tasks/'+this.$route.params.id,{description: this.description})
                        .then(res =>{
                            this.success = true
                            this.msgSuccess = res.data
                        })
                }
            }
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