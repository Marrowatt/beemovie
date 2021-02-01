<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8">
                <h1>Cadastre as abelhas</h1>
            </div>
        </div>

        <div class="row">

            <div class="col-12">

                <form class="createform" v-on:submit.prevent="createBee" method="post">

                    <label for="common_name">Nome: </label>
                    <input type="text" name="common_name" id="common_name" class="form-control mb-2"
                    placeholder="Qual o nome da abelha" v-model="bee.common_name">

                    
                    <label for="scientific_name">Espécie: </label>
                    <input type="text" name="scientific_name" id="scientific_name" class="form-control mb-2"
                    placeholder="Qual a espécie ou nome científico" v-model="bee.scientific_name">

                    <div class="col-6 offset-6 text-right">
                        <a href="#" class="btn btn-outline-primary col-5 mr-2">Cancelar</a> 
                        
                        <button type="submit"  class="btn btn-primary col-5">Cadastrar abelha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                bee: {
                    common_name: "",
                    scientific_name: ''
                }
            }
        },
        methods: {
            createBee () {
                axios.post('createBee', this.bee).then(data => (
                    this.$router.go("/")
                ));
            }
        }
    }
</script>
