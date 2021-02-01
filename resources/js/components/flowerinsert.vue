<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8">
                <h1>Cadastre as flores</h1>
            </div>
        </div>

        <div class="row">

            <div class="col-8">

                <form class="createform" v-on:submit.prevent="createFlower" method="post">

                    <label for="name">Nome: </label>
                    <input type="text" name="name" id="name" class="form-control mb-2"
                    placeholder="Qual o nome da flor" v-model="flower.name">
                    
                    <label for="species">Espécie: </label>
                    <input type="text" name="species" id="species" class="form-control mb-2" 
                    placeholder="Qual a espécie ou nome científico" v-model="flower.species">

                    <!-- <div class="col-6 offset-6 text-right">
                        <a href="#" class="btn btn-outline-primary col-5 mr-2">Cancelar</a> 
                        
                        <button type="submit"  class="btn btn-primary col-5">Cadastrar flor</button>
                    </div> -->
                </form>
            </div>

            <div class="col-4">
                Escolha uma imagem
            </div>

            <div class="col-10">

                <label for="description">Descrição: </label>
                <input type="text" name="description" id="description" class="form-control mb-2" 
                placeholder="Escreva uma breve descrição sobre a flor" v-model="flower.description">

            </div>

            <div class="col-12">

                <label> Quais os meses a flor irá florescer </label>

                <div class="row">

                    <div class="border text-center py-3 px-4 m-2" v-for="(m, index) in months" :key="index">
                        <p>{{ m.name.substr(0, 3) }}</p>
                    </div>

                </div>

            </div>


            <div class="col-12">
                
                <label> Selecione as abelhas que polinizam essas flores </label>

                <multiselect v-model="flower.bees_id" :options="bees" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" label="common_name" track-by="id">
                </multiselect>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                flower: {
                    name: "",
                    species: "",
                    description: "",
                    months_id: [],
                    bees_id: []
                },
                bees: [],
                months: []
            }
        },
        mounted () {
            this.getBees();

            this.getMonths();
        },
        methods: {
            createBee () {
                axios.post('createFlower', this.flower).then(data => (
                    this.$router.go("/")
                ));
            },
            getBees() {
                axios.get('/getBees').then(data => (

                    this.bees = data.data
                ));
            },
            getMonths() {
                axios.get('/getMonths').then(data => (

                    this.months = data.data
                ));
            }
        }
    }
</script>
