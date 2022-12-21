<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <router-link :to="{ name: 'buku.create' }" class="btn btn-md btn-success">TAMBAH BUKU</router-link>
                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><center>Nama Buku</center></th>
                                    <th scope="col"><center>Tahun Terbit</center></th>
                                    <th scope="col"><center>Synopsis</center></th>
                                    <th scope="col"><center>Genre</center></th>
                                    <th scope="col"><center>Harga</center></th>
                                    <th scope="col"><center>Penulis</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(buku, id) in buku" :key="id">
                                    <td><center>{{ buku.nama }}</center></td>
                                    <td><center>{{ buku.tahun_terbit }}</center></td>
                                    <td><center>{{ buku.synopsis }}</center></td>
                                    <td><center>{{ buku.genre }}</center></td>
                                    <td><center>{{ buku.harga }}</center></td>
                                    <td><center>{{ buku.penulis }}</center></td>
                                    <td class="text-center">
                                        <router-link :to="{ name:
                                        'buku.update', params: { id: buku.id } }" class="btn
                                        btn-sm btn-primary mr-1">
                                        EDIT</router-link>
                                        <button class="btn btn-sm btn-danger ml-1" @click="postDelete(buku.id)">DELETE</button>
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
import { useRouter } from 'vue-router'
export default {
    setup() {
        //reactive state
        let buku = ref([])
        const validation = ref([])
        const router = useRouter()
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/buku')
                .then(response => {
                    //assign state posts with response data
                    buku.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function postDelete(id){
            axios.delete(`http://localhost:8000/api/buku/${id}`,{
                }).then(()=>{
                    router.push({
                        name: 'buku.index'
                    })
                }).catch(error =>{
                    validation.value = error.response.data
                })
            }
        //return
        return {
            buku,
            postDelete
        }
    },

    methods: {
        deleteFromRow(id) {
        axios.delete(`http://localhost:8000/api/buku/${id}`)
            .then(() => {
               const index = this.buku.findIndex(buku => buku.id === id)
                if(index){
                    this.buku.splice(id, 1)
                } 
            }).catch(error => {
                console.log(error.response.data)
            })
        this.buku.splice(id, 1);
        }
    }       
}
</script>

<style>

</style>