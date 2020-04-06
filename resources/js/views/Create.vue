<template>
    <form class="container" style="width:50%">
        <h1>Création d'une tâche</h1>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control mb-2" id="description" name="description" v-model.trim="$v.description.$model" rows="3"></textarea>
            <button @click="check" type="button" class="btn btn-success">Valider</button>
        </div>
        <div v-if="errors.length">
            <div class="p-3 mb-2 bg-danger text-white rounded"> {{errors[0]}}</div>
        </div>
        <div v-if="success">
            <div class="p-3 mb-2 bg-success text-white rounded">{{msgSuccess}}</div>
        </div>
    </form>
</template>
<script>
    import { required } from 'vuelidate/lib/validators'
    import axios from "axios"
    export default {
        name:"create",
        data(){
            return {
                errors: [],
                description:null,
                success:false,
                msgSuccess:null
            }
        },
        validations: {
            description: {
                required,
            },
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
                    axios.post('http://api/tasks',{description: this.description})
                        .then(res =>{
                            this.success = true
                            this.msgSuccess = res.data
                            this.$v.description.$model = null
                        })
                }
            }
        }
    }
</script>