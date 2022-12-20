<template>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container">
            <!-- Nama : nama panggilan kalian -->
            <router-link :to="{ name: 'beranda' }" class="btn btn-info me-2">Return</router-link>
            <a class="navbar-brand fw-bold" href="../index.php">COMIC READER 10815</a>
            <div class="d-flex justify-content-end">
                <router-link :to="{ name: 'register' }" class="btn btn-primary me-2">Sign Up</router-link>
                <router-link :to="{ name: 'login' }" class="btn btn-warning ms-2">Login</router-link>
            </div>
        </div>
    </nav>
    <section class="h-100 h-custom"
        style="background-image:url(https://media.tenor.com/9vRAkntogEMAAAAd/background.gif)">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="https://media.tenor.com/Q0krNyOkPOcAAAAC/%E3%81%90%E3%82%89-%E3%83%9B%E3%83%AD%E3%83%A9%E3%82%A4%E3%83%96.gif"
                            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                            alt="Sample photo">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>

                            <form  @submit.prevent="store" class="px-md-2">

                                <div class="form-outline mb-4">
                                    <label class="form-label">Nama Pengguna</label>
                                    <input type="text" class="form-control" v-model="pengguna.nama"
                                        placeholder="Masukkan Nama Pengguna">
                                    <!-- validation -->
                                    <div v-if="validation.nama" class="mt-2 alert alert-danger">
                                        {{
                                                validation.nama[0]
                                        }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-group mb-2">
                                            <label for="content" class="form-label">Password</label>
                                            <input type="password" class="form-control" v-model="pengguna.password"
                                                placeholder="Masukkan Password">
                                            <!-- validation -->
                                            <div v-if="validation.password" class="mt-2 alert alert-danger">
                                                {{
                                                        validation.password[0]
                                                }}
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Email</label>
                                    <input class="form-control" v-model="pengguna.email" placeholder="Masukkan Email">
                                    <!-- validation -->
                                    <div v-if="validation.email" class="mt-2 alert alert-danger">
                                        {{ validation.email[0]
                                        }}
                                    </div>
                                </div>

                                <div class="row mb-4 pb-2 pb-md-0 mb-md-5">
                                    <div class="col-md-12">
                                        <label for="content" class="form-label">Telepon</label>
                                        <input class="form-control" v-model="pengguna.telepon"
                                            placeholder="Masukkan Nomor Telepon">
                                        <!-- validation -->
                                        <div v-if="validation.telepon" class="mt-2 alert alert-danger">
                                            {{
                                                    validation.telepon[0]
                                            }}
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success btn-lg mb-1">Save</button>
                                <router-link :to="{ name: 'login' }"
                                    class="btn btn-danger btn-lg mb-1">Back</router-link>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    setup() {
        //state pengguna
        const pengguna = reactive({
            pengguna: '',
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
            let nama = pengguna.nama
            let password = pengguna.password
            let email = pengguna.email
            let telepon = pengguna.telepon
            axios.post('http://localhost:8000/api/pengguna', {
                nama: nama,
                password: password,
                email: email,
                telepon: telepon
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'pengguna.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            pengguna,
            validation,
            router,
            store
        }
    }
}
</script>