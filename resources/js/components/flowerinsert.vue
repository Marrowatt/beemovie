<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8">
                <h1>Cadastre as flores</h1>
            </div>
        </div>

        <form class="createform" v-on:submit.prevent="createFlower" method="post" enctype="multipart/form-data">
            <div class="row">

                <div class="col-8">

                    <label for="name">Nome: </label>
                    <input type="text" name="name" id="name" class="form-control mb-2"
                    placeholder="Qual o nome da flor" v-model="flower.name">
                    
                    <label for="species">Espécie: </label>
                    <input type="text" name="species" id="species" class="form-control mb-2" 
                    placeholder="Qual a espécie ou nome científico" v-model="flower.species">

                </div>

                <div class="col-4 mx-auto text-center">

                    <label for="file-upload" class="col-6 offset-3 py-5 bg-primary text-center rounded-circle">
                        <i class="fa fa-3x fa-cloud-upload text-white"></i>
                    </label>

                    <input type="file" id="file-upload" accept="image/jpeg, image/jpg, image/png" hidden @change=uploadImage>
<!-- 
                    <div class="text-right">
                        <img :src="image_prev" class="mx-auto text-center img-fluid h-75" width="100px"/>
                    </div> -->
                </div>

                <div class="col-10">

                    <label for="description">Descrição: </label>
                    <input type="text" name="description" id="description" class="form-control mb-2" 
                    placeholder="Escreva uma breve descrição sobre a flor" v-model="flower.description">

                </div>

                <div class="col-12">

                    <label> Quais os meses a flor irá florescer </label>

                    <div class="row">
                        <div class="border text-center py-3 px-4 m-2" v-for="(item) in months" :key="item.id" v-bind:class="{ active: flower.months_id == item, 'bg-primary': exists(item)[0] ? false : true }" @click="meucasal(item)">
                            <p>{{ item.name.substr(0, 3) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    
                    <label> Selecione as abelhas que polinizam essas flores </label>

                    <multiselect v-model="flower.bees_id" :options="bees" :multiple="true" :close-on-select="false" :clear-on-select="false" 
                    :preserve-search="true" label="common_name" track-by="id"></multiselect>

                </div>

                <div class="col-6 offset-6 text-right mt-3">
                    <a href="#" class="btn btn-outline-primary col-5 mr-2">Cancelar</a> 
                    
                    <button type="submit" class="btn btn-primary col-5">Cadastrar flor</button>
                </div>
            </div>
        </form>
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
                    bees_id: [],
                },
                bees: [],
                months: [],
                image: null,
                image_prev: null
            }
        },
        mounted () {
            this.getBees();

            this.getMonths();
        },
        methods: {
            uploadImage(e) {

                this.image = e.target.files[0];

                let fr = new FileReader();
                fr.readAsDataURL(this.image);
                fr.onload = e => {
                    this.image_prev = e.target.result;
                }
            },
            createFlower () {
                
                var formData = new FormData();

                var months = [];

                this.flower.months_id.forEach(el => {
                    months.push([el.id]);
                });

                var bees = [];

                this.flower.bees_id.forEach(el => {
                    bees.push(el.id);
                });

                formData.append('image', this.image, this.image.name);
                formData.append('name', this.flower.name);
                formData.append('species', this.flower.species);
                formData.append('description', this.flower.description);
                formData.append('months_id', months);
                formData.append('bees_id', bees);
                
                var config = {
                    header: {
                        'Content-Type' : 'multipart/form-data'
                    }
                }

                axios.post('createFlower', formData, config).then(data => (
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
            },
            meucasal(item) {
                
                var chinchila = this.exists(item);

                if(chinchila[0] == false) {
                    this.flower.months_id.splice(chinchila[1], 1);
                } else {
                    this.flower.months_id.push(item);
                }

                return chinchila;
            },
            exists(item) {

                let position = 0;

                var chinchila = this.flower.months_id.every(function(el, index) {

                    if(el.id == item.id) {
                        position = index;
                        return false;
                    } else { 
                        return true;
                    }
                });

                return [chinchila, position];
            }
        }
    }
</script>
