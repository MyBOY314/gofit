<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH PENULIS</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Penulis</label>
                                <input type="text" class="form-control" v-model="penulis.nama" placeholder="Masukkan Nama Penulis">
                                <div v-if="validation.nama" class="mt-2 alert alert-danger">{{validation.nama[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Tanggal Lahir</label>
                                <input class="form-control" v-model="penulis.tanggal_lahir" placeholder="Masukkan Tanggal Lahir">
                                <div v-if="validation.tanggal_lahir" class="mt-2 alert alert-danger">{{validation.tanggal_lahir[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Deskripsi Penulis</label>
                                <input class="form-control"  v-model="penulis.deskripsi" placeholder="Masukkan Deskripsi Penulis">
                                <div v-if="validation.deskripsi" class="mt-2 alert alert-danger">{{validation.deskripsi[0]}}</div>
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

export default{
    setup(){
        const penulis = reactive({
            nama: '',
            tanggal_lahir: '',
            deskripsi: '',
        })

        const validation = ref([])

        const router = useRouter()

        function store(){
            let nama = penulis.nama
            let tanggal_lahir = penulis.tanggal_lahir
            let deskripsi = penulis.deskripsi

            axios.post('http://localhost:8000/api/penulis',{
                nama: nama,
                tanggal_lahir: tanggal_lahir,
                deskripsi: deskripsi
            }).then(()=>{
                router.push({
                    name: 'penulis.index'
                })  
            }).catch(error=>{
                validation.value = error.response.data
            })
        }
        return{
            penulis,
            validation,
            router,
            store
        }
    }
}
</script>

<style>
</style>