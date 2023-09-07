<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH INSTRUKTUR</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Instruktur</label>
                                <input type="text" class="form-control" v-model="instruktur.nama_instruktur"
                                    placeholder="Masukkan Nama Instruktur">
                                <!-- validation -->
                                <div v-if="validation.nama_instruktur" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nama_instruktur[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Password</label>
                                <input type="password" class="form-control" v-model="instruktur.password_instruktur"
                                    placeholder="Masukkan Password">
                                <!-- validation -->
                                <div v-if="validation.password_instruktur" class="mt-2 alert alert-danger">
                                    {{
                                            validation.password_instruktur[0]
                                    }}
                                </div>
                            </div>
                            <!-- <div class="form-group mb-3">
                                <label for="content" class="form-label">Konfirmasi Password</label>
                                <input class="form-control" v-model="instruktur.password"
                                    placeholder="Konfirmasi Password">

                                <div v-if="validation.password" class="mt-2 alert alert-danger">
                                    {{
                                            validation.password[0]
                                    }}
                                </div>
                            </div> -->
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input class="form-control" v-model="instruktur.email" placeholder="Masukkan Email">
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ 
                                    validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Telepon</label>
                                <input class="form-control" v-model="instruktur.nomor_telepon"
                                    placeholder="Masukkan Nomor Telepon">
                                <!-- validation -->
                                <div v-if="validation.nomor_telepon" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nomor_telepon[0]
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
        //state instruktur
        const instruktur = reactive({
            instruktur: '',
            password_instruktur: '',
            email: '',
            nomor_telepon: '',
            terlambat:''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        //method store
        function store() {
            let nama_instruktur = instruktur.nama_instruktur
            let password_instruktur = instruktur.password_instruktur
            let email = instruktur.email
            let nomor_telepon = instruktur.nomor_telepon
            let terlambat = 0
            axios.post('http://localhost:8000/api/instruktur', {
                nama_instruktur: nama_instruktur,
                password_instruktur: password_instruktur,
                email: email,
                nomor_telepon: nomor_telepon,
                terlambat : terlambat,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'instruktur.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        return {
            instruktur,
            validation,
            router,
            store
        }
    }
}
</script>
<style>

</style>