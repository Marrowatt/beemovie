<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8">
                <h1>Calendário de flores</h1>

                <p>Neste calendário encontram-se diversas flores.<br>
                Podem ser agrupadas pelos meses que florescem e / ou <br>
                pelo tipo de abelha que poliniza a flor. </p>
            </div>
            <div class="col-md-4 text-center">

                <router-link to="/flowerinsert" class="btn btn-secondary col-8 my-2">Cadastrar flores</router-link>

                <router-link to="/beeinsert" class="btn btn-secondary col-8">Cadastrar abelha</router-link>

            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                
                <label> Selecione as abelhas </label>

                <multiselect v-model="bees_id" :options="bees" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" label="common_name" track-by="id">
                </multiselect>

            </div>
        </div>

        <div class="row mt-3">

            <div class="col-12 my-2">

                Escolha os meses:

                <div class="row">

                    <div class="border text-center py-3 px-4 m-2" v-for="(m, index) in months" :key="index">
                        <p>{{ m.name.substr(0, 3) }}</p>
                    </div>

                </div>
            </div>

        </div>

        <div class="row mt-3">

            <div class="col-12 my-2">

                <div class="row">
                    <div class="col-3">

                        <img src="#" alt="Nome da flor">

                        <p>Nome da flor</p>

                    </div>

                    <div class="col-3">

                        <img src="#" alt="Nome da flor">

                        <p>Nome da flor</p>

                    </div>

                    <div class="col-3">

                        <img src="#" alt="Nome da flor">

                        <p>Nome da flor</p>

                    </div>

                    <div class="col-3">

                        <img src="#" alt="Nome da flor">

                        <p>Nome da flor</p>

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
                bees_id: null,
                bees: [],
                months: [],
            }
        },
        mounted() {
            this.getBees();

            this.getMonths();
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
            }
        }
    }

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>