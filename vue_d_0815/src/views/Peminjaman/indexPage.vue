<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <router-link :to="{ name: 'peminjaman.create' }" class="btn btn-md btn-success">TAMBAH PEMINJAMAN</router-link>
                        <table class="table table-striped table-bordered mt4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><center>Tanggal Peminjaman</center></th>
                                    <th scope="col"><center>Durasi Peminjaman</center></th>
                                    <th scope="col"><center>Buku</center></th>
                                    <th scope="col"><center>Pengguna</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(peminjaman, id) in peminjaman" :key="id">
                                    <td><center>{{ peminjaman.tanggal_peminjaman }}</center></td>
                                    <td><center>{{ peminjaman.durasi_peminjaman }}</center></td>
                                    <td><center>{{ peminjaman.buku }}</center></td>
                                    <td v-for="pengguna in pengguna" :key="pengguna.id" :value="pengguna.id">
                                    <!-- <td v-if="pengguna.id === peminjaman.pengguna"></td> -->
                                    <center>
                                        {{ pengguna.nama }}</center></td>
                                    <td class="text-center">

                                        <router-link :to="{ name:
   'peminjaman.update', params: { id: peminjaman.id } }" class="btn
    btn-sm btn-primary mr-1">
    EDIT</router-link>
    <button @click="deleteFromRow(peminjaman.id)" class="btn btn-sm btn-danger ml1">DELETE</button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'
export default {
    setup() {

//reactive state
let buku = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/buku')
                .then(response => {
                    //assign state posts with response data
                    buku.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

//reactive state
let pengguna = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/pengguna')
                .then(response => {
                    //assign state posts with response data
                    pengguna.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //reactive state
        let peminjaman = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/peminjaman')
                .then(response => {
                    //assign state posts with response data
                    peminjaman.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/peminjaman/${id}`)
                .then(() => {
                    const index = this.peminjaman.findIndex(peminjaman => peminjaman.id === id)
                    if(index){
                        this.peminjaman.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }
        

        //return
        return {
            peminjaman,
            destroy,
            buku,
            pengguna,
        }

    },

    methods: {
        deleteFromRow(id) {

axios.delete(`http://127.0.0.1:8000/api/peminjaman/${id}`)
        .then(() => {
            const index = this.peminjaman.findIndex(peminjaman => peminjaman.id === id)
            if(index){
                this.peminjaman.splice(id, 1)
            }
        
        }).catch(error => {
            console.log(error.response.data)
        })

this.peminjaman.splice(id, 1);
}
}
        
}
</script>
<style>

</style>