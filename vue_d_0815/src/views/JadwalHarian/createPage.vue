<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH JADWAL</h4>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Hari</label>
                                <input type="text" class="form-control" v-model="jadwalUmum.hari"
                                    placeholder="Masukkan Hari Jadwal">
                                <!-- validation -->
                                <div v-if="validation.hari" class="mt-2 alert alert-danger">
                                    {{
                                            validation.hari[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Kelas</label>
                                <select class="select form-control" v-model="jadwalUmum.kelas_id" placeholder="Pilih Kelas">
                                    <option disabled selected style="display: ruby;">Pilih Kelas</option>
                                    <option v-for="kelas_id in kelas_id" :key="kelas_id.id" :value="kelas_id.id">
                                    {{ kelas_id.nama }}
                                    </option>
                                </select>
                                <div v-if="validation.kelas" class="mt-2 alert alert-danger">{{validation.kelas[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Instruktur</label>
                                <select class="select form-control" v-model="jadwalUmum.instruktur_id" placeholder="Pilih Instruktur">
                                    <option disabled selected style="display: ruby;">Pilih Instruktur</option>
                                    <option v-for="instruktur_id in instruktur" :key="instruktur_id.id" :value="instruktur_id.id">
                                    {{ instruktur_id.nama }}
                                    </option>
                                </select>
                                <div v-if="validation.instruktur" class="mt-2 alert alert-danger">{{validation.instruktur[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Jam</label>
                                <input type="time" class="form-control" v-model="jadwalUmum.jam" placeholder="Masukkan Jam">
                                <!-- validation -->
                                <div v-if="validation.jam" class="mt-2 alert alert-danger">
                                    {{
                                    validation.jam[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Tariff</label>
                                <input type="number" class="form-control" v-model="jadwalUmum.tariff"
                                    placeholder="Masukkan Tariff (Rp)">
                                <!-- validation -->
                                <div v-if="validation.tariff" class="mt-2 alert alert-danger">
                                    {{
                                            validation.tariff[0]
                                    }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { onMounted,reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    setup() {
        let instruktur = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/instruktur')
                .then(response => {
                    //assign state posts with response data
                    instruktur.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })
        //state JadwalUmum
        const jadwalUmum = reactive({
            jadwalUmum: '',
            hari: '',
            kelas_id: '',
            instruktur_id: '',
            jam: '',
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        //method store
        function store() {
            let hari = jadwalUmum.hari
            let kelas = jadwalUmum.kelas_id
            let instruktur = jadwalUmum.instruktur_id
            let jam = jadwalUmum.jam
            axios.post('http://localhost:8000/api/jadwalUmum', {
                hari: hari,
                kelas: kelas,
                instruktur: instruktur,
                jam: jam,
                
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'JadwalUmum.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        return {
            jadwalUmum,
            validation,
            router,
            store
        }
    }
}
</script>
<style>

</style>