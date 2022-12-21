<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH BUKU</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Buku</label>
                                <input type="text" class="form-control" v-model="buku.nama" placeholder="Masukkan Nama Buku">
                                <div v-if="validation.nama" class="mt-2 alert alert-danger">{{validation.nama[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Tahun Terbit</label>
                                <input class="form-control" v-model="buku.tahun_terbit" placeholder="Masukkan Tahun Terbit Buku">
                                <div v-if="validation.tahun_terbit" class="mt-2 alert alert-danger">{{validation.tahun_terbit[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Synopsis Buku</label>
                                <input class="form-control"  v-model="buku.synopsis" placeholder="Masukkan Synopsis Buku">
                                <div v-if="validation.synopsis" class="mt-2 alert alert-danger">{{validation.synopsis[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Genre Buku</label>
                                <input class="form-control"  v-model="buku.genre" placeholder="Masukkan Genre Buku">
                                <div v-if="validation.genre" class="mt-2 alert alert-danger">{{validation.genre[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Harga Buku</label>
                                <input class="form-control"  v-model="buku.harga" placeholder="Masukkan Harga Buku">
                                <div v-if="validation.harga" class="mt-2 alert alert-danger">{{validation.harga[0]}}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Penulis Buku</label>
                                <input class="form-control"  v-model="buku.penulis" placeholder="Masukkan Penulis Buku">
                                <div v-if="validation.penulis" class="mt-2 alert alert-danger">{{validation.penulis[0]}}</div>
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
        const buku = reactive({
            nama: '',
            tahun_terbit: '',
            synopsis: '',
            genre: '',
            harga: '',
            penulis: ''
        })

        const validation = ref([])

        const router = useRouter()

        function store(){
            let nama = buku.nama
            let tahun_terbit = buku.tanggal_lahir
            let synopsis = buku.deskripsi
            let genre = buku.genre
            let harga = buku.harga
            let penulis = buku.penulis

            axios.post('http://localhost:8000/api/buku',{
                nama: nama,
                tahun_terbit: tahun_terbit,
                synopsis: synopsis,
                genre: genre,
                harga: harga,
                penulis: penulis
            }).then(()=>{
                router.push({
                    name: 'buku.index'
                })  
            }).catch(error=>{
                validation.value = error.response.data
            })
        }
        return{
            buku,
            validation,
            router,
            store
        }
    }
}
</script>

<style>
</style>