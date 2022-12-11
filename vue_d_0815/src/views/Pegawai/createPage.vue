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
                                <label class="form-label">Nomor Induk Pegawai</label>
                                <input type="text" class="form-control" v-model="pegawai.nomor_induk_pegawai"
                                    placeholder="Masukkan nomor induk pegawai">
                                <!-- validation -->
                                <div v-if="validation.nomor_induk_pegawai" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nomor_induk_pegawai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Nama Pegawai</label>
                                <input class="form-control" v-model="pegawai.nama_pegawai" placeholder="Masukkan nama pegawai">
                                <!-- validation -->
                                <div v-if="validation.nama_pegawai" class="mt-2 alert alert-danger">
                                    {{ validation.nama_pegawai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Nama Departemen</label>
                                <input class="form-control" type="number" v-model="pegawai.nama_manager"
                                    placeholder="Masukkan nama departemen">
                                <!-- validation -->
                                <div v-if="validation.jumlah_pegawai" class="mt-2 alert alert-danger">
                                    {{
                                            validation.jumlah_pegawai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input class="form-control" type="number" v-model="pegawai.email"
                                    placeholder="Masukkan Email">
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{
                                            validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Nomor Telepon</label>
                                <input class="form-control" type="number" v-model="pegawai.telepon"
                                    placeholder="Masukkan nomor telepon">
                                <!-- validation -->
                                <div v-if="validation.telepon" class="mt-2 alert alert-danger">
                                    {{
                                            validation.telepon[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Gender</label>
                                <input class="form-control" type="number" v-model="pegawai.gender"
                                    placeholder="Masukkan Gender">
                                <!-- validation -->
                                <div v-if="validation.gender" class="mt-2 alert alert-danger">
                                    {{
                                            validation.gender[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Status</label>
                                <input class="form-control" type="number" v-model="pegawai.status"
                                    placeholder="Masukkan Status">
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
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    setup() {
        //state pegawai
        const pegawai = reactive({
            nama_pegawai: '',
            nama_manager: '',
            jumlah_pegawai: ''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        //method store
        function store() {
            let nama_pegawai = pegawai.nama_pegawai
            let nama_manager = pegawai.nama_manager
            let jumlah_pegawai = pegawai.jumlah_pegawai
            axios.post('http://localhost:8000/api/pegawais', {
                nama_pegawai: nama_pegawai,
                nama_manager: nama_manager,
                jumlah_pegawai: jumlah_pegawai
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'pegawai.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            pegawai,
            validation,
            router,
            store
        }
    }
}
</script>
<style>

</style>