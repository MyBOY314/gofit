<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH PEMINJAMAN</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Tanggal Peminjaman</label>
                                <input class="form-control" type="date" v-model="peminjaman.waktu_mulai"
                                    placeholder="Masukkan Tanggal Mulai">
                                <!-- validation -->
                                <div v-if="validation.waktu_mulai" class="mt-2 alert alert-danger">
                                    {{
                                            validation.waktu_mulai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Password</label>
                                <input type="password" class="form-control" v-model="peminjaman.password"
                                    placeholder="Masukkan Password">
                                <!-- validation -->
                                <div v-if="validation.password" class="mt-2 alert alert-danger">
                                    {{
                                            validation.password[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Konfirmasi Password</label>
                                <input class="form-control" v-model="peminjaman.password"
                                    placeholder="Konfirmasi Password">
                                <!-- validation -->
                                <div v-if="validation.password" class="mt-2 alert alert-danger">
                                    {{
                                            validation.password[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input class="form-control" v-model="peminjaman.email" placeholder="Masukkan Email">
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Telepon</label>
                                <input class="form-control" v-model="peminjaman.telepon"
                                    placeholder="Masukkan Nomor Telepon">
                                <!-- validation -->
                                <div v-if="validation.telepon" class="mt-2 alert alert-danger">
                                    {{
                                            validation.telepon[0]
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
        //state peminjaman
        const peminjaman = reactive({
            peminjaman: '',
            password: '',
            email: '',
            telepon: ''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        //method store
        function store() {
            let nama = peminjaman.nama
            let password = peminjaman.password
            let email = peminjaman.email
            let telepon = peminjaman.telepon
            axios.post('http://localhost:8000/api/peminjaman', {
                nama: nama,
                password: password,
                email: email,
                telepon: telepon
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'peminjaman.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            peminjaman,
            validation,
            router,
            store
        }
    }
}
</script>
<style>

</style>