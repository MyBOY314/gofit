<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>UPDATE POST</h4>
                        <hr>
                        <form @submit.prevent="update">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama jadwalUmum</label>
                                <input type="text" class="form-control" v-model="jadwalUmum.hari"
                                    placeholder={{jadwalUmum.hari}}>
                                <!-- validation -->
                                <div v-if="validation.hari" class="mt-2 alert alert-danger">
                                    {{
                                            validation.hari[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Kelas</label>
                                <input type="text" class="form-control" v-model="jadwalUmum.kelas" placeholder={{jadwalUmum.kelas}}>
                                <!-- validation -->
                                <div v-if="validation.kelas" class="mt-2 alert alert-danger">
                                    {{ validation.kelas[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Jam</label>
                                <input type="time" class="form-control" v-model="jadwalUmum.jam"
                                    placeholder={{jadwalUmum.jam}}>
                                <!-- validation -->
                                <div v-if="validation.jam" class="mt-2 alert alert-danger">
                                    {{
                                            validation.jam[0]
                                    }}
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Tariff</label>
                                <input class="form-control" type="number" v-model="jadwalUmum.tariff"
                                    placeholder="Masukkan Tariff">
                                <!-- validation -->
                                <div v-if="validation.tariff" class="mt-2 alert alert-danger">
                                    {{
                                            validation.tariff[0]
                                    }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                            <router-link :to="{ name: 'jadwalUmum.index' }" type="submit" class="btn btn-danger">BACK</router-link>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive, onMounted, ref} from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'


export default {
    setup() {
        //state jadwalUmum
        const jadwalUmum = reactive({
            jadwalUmum: '',
            hari: '',
            kelas: '',
            jam: '',
            tariff:'',
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        const route = useRoute()

//mounted
onMounted(() => {

//get API from Laravel Backend
axios.get(`http://localhost:8000/api/jadwalUmum/${route.params.id}`)
.then(response => {
            
    //assign state jadwalUmum with response data
    jadwalUmum.hari= response.data.data.hari,
    jadwalUmum.kelas= response.data.data.kelas,
    jadwalUmum.jam= response.data.data.jam
    jadwalUmum.tariff= response.data.data.tariff

}).catch(error => {
    console.log(error.response.data)
})

})
        //method update
        function update() {
            let hari = jadwalUmum.hari
            let kelas = jadwalUmum.kelas
            let jam = jadwalUmum.jam
            let tariff = jadwalUmum.tariff
            axios.put(`http://localhost:8000/api/jadwalUmum/${route.params.id}`, {
                hari: hari,
                kelas: kelas,
                jam: jam,
                tariff: tariff,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'jadwalUmum.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            jadwalUmum,
            validation,
            router,
            update
        }
    }
}
</script>
<style>

</style>