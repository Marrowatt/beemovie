<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8">
                <h1>Calendário de flores</h1>

                <p>Neste calendário encontram-se diversas flores.<br>
                Podem ser agrupadas pelos meses que florescem e / ou <br>
                pelo tipo de abelha que poliniza a flor. </p>
            </div>

            <div class="col-md-4 text-right">

                <router-link to="/flowerinsert" class="btn btn-secondary col-8 my-2">Cadastrar flores</router-link>

                <router-link to="/beeinsert" class="btn btn-secondary col-8">Cadastrar abelha</router-link>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                
                <label> Selecione as abelhas </label>

                <multiselect v-model="flower.bees_id" :options="bees" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" label="common_name" track-by="id">
                </multiselect>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-12 my-2">

                Escolha os meses:

                <div class="row text-center mx-auto">
                    <div class="border text-center py-3 px-4 m-2" v-for="(item) in months" :key="item.id" v-bind:class="{ active: flower.months_id == item, 'bg-primary': exists(item)[0] ? false : true }" @click="meucasal(item)">
                        <p>{{ item.name.substr(0, 3) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-12 my-2">

                <div class="row mb-5">

                    <div class="col-3 text-center" v-b-modal.modal-1 v-for="(f, index) in flowers" :key="index" @click="comparador = index">

                        <img :src="`/storage/${f.image}`" :alt="f.species" width="80%" 
                        class="img-thumbnail rounded-circle" style="height: 190px">

                        <p class="mt-2">{{f.name}}</p>

                        <b-modal id="modal-1" v-if="index == comparador">
                            <img :src="`/storage/${f.image}`" :alt="f.species" width="80%" class="img-thumbnail" style="height: 190px">
 
                            <p class="mt-2">{{f.name}}</p>

                            <p class="mt-2">{{f.description}}</p>

                            <p class="mt-2">Abelhas</p>
                        </b-modal>
                    </div> 
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                bees: [],
                months: [],
                bees_id: [],
                months_id: [],
                flower: {
                    months_id: [],
                    bees_id: []
                },
                flowers: {},
                comparador: null,
            }
        },
        mounted() {
            this.getBees();

            this.getMonths();

            this.searchFlowers();
        },
        methods: {
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
                    this.months_id.splice(chinchila[1], 1);
                } else {
                    this.flower.months_id.push(item);
                    this.months_id.push(item);
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
            },
            searchFlowers() {

                axios.get('/searchFlowers', {params: this.flower}).then(data => (

                    this.flowers = data.data
                ));
            }
        },
        watch: {
            'flower.bees_id' (val) {
                this.searchFlowers();
            },
            'flower.months_id' (val) {
                this.searchFlowers();
            }
        }
    }

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>