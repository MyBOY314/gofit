<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH POST</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Nama proyek</label>
                                <input class="form-control" v-model="proyek.nama_proyek" placeholder="Masukkan nama proyek">
                                <!-- validation -->
                                <div v-if="validation.nama_proyek" class="mt-2 alert alert-danger">
                                    {{ validation.nama_proyek[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Nama Departemen</label>
                                <select class="form-control" v-model="proyek.id_departemen" placeholder="Pilih Departemen">
                                    <option disabled selected style="display: none;">Pilih Departemen</option>
                                    <option v-for="departemen in departemens" :key="departemen.id" :value="departemen.id">
                                    {{ departemen.nama_departemen }}
                                    </option>
                                </select>
                                <!-- validation -->
                                <div v-if="validation.id_departemen" class="mt-2 alert alert-danger">
                                    {{
                                            validation.id_departemen[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Waktu mulai</label>
                                <input class="form-control" type="date" v-model="proyek.waktu_mulai"
                                    placeholder="Masukkan Tanggal Mulai">
                                <!-- validation -->
                                <div v-if="validation.waktu_mulai" class="mt-2 alert alert-danger">
                                    {{
                                            validation.waktu_mulai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Waktu selesai</label>
                                <input class="form-control" type="date" v-model="proyek.waktu_selesai"
                                    placeholder="Masukkan Tanggal Selesai">Pilih
                                <!-- validation -->
                                <div v-if="validation.waktu_selesai" class="mt-2 alert alert-danger">
                                    {{
                                            validation.waktu_selesai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Status</label>
                                <select class="form-control" type="select" v-model="proyek.status"
                                    placeholder="Masukkan Status">
                                    <option disabled selected style="display: none;">Pilih Status</option>
                                    <option value="0">
                                    Aktif
                                    </option>
                                    <option value="1">
                                    Tidak Aktif
                                    </option>
                                </select>
                                <!-- validation -->
                                <div v-if="validation.status" class="mt-2 alert alert-danger">
                                    {{
                                            validation.status[0]
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
import {  onMounted, reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    setup() {

         //reactive state
         let departemens = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/departemens')
                .then(response => {
                    //assign state posts with response data
                    departemens.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //state proyek
        const proyek = reactive({
            nama_proyek: '',
            nama_manager: '',
            jumlah_proyek: ''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        //method store
        function store() {
            let nama_proyek = proyek.nama_proyek
            let nama_manager = proyek.nama_manager
            let jumlah_proyek = proyek.jumlah_proyek
            axios.post('http://localhost:8000/api/proyeks', {
                nama_proyek: nama_proyek,
                nama_manager: nama_manager,
                jumlah_proyek: jumlah_proyek
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'proyek.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            proyek,
            validation,
            router,
            store,
            departemens,
        }
    }
}
</script>
<style>

</style>