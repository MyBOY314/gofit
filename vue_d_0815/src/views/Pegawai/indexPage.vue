<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <router-link :to="{ name: 'pegawai.create' }" class="btn btn-md btn-success">TAMBAH PEGAWAI</router-link>
                        <table class="table table-striped table-bordered mt4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><center>NIP</center></th>
                                    <th scope="col"><center>NAMA PEGAWAI</center></th>
                                    <th scope="col"><center>DEPARTEMEN</center></th>
                                    <th scope="col"><center>EMAIL</center></th>
                                    <th scope="col"><center>GENDER</center></th>
                                    <th scope="col"><center>STATUS</center></th>
                                    <th scope="col"><center>AKSI</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pegawai, id) in pegawais" :key="id">
                                    <td><center>{{ pegawai.nomor_induk_pegawai }}</center></td>
                                    <td><center>{{ pegawai.nama_pegawai}}</center></td>
                                    <td><center>{{ pegawai.nama_departemen }}</center></td>
                                    <td><center>{{ pegawai.email }}</center></td>
                                    <td><center>{{ pegawai.telepon }}</center></td>
                                    <td><center>{{ pegawai.gender ? "Wanita" : "Pria" }}</center></td>
                                    <td><center>{{ pegawai.status ? "Tidak Aktif" : "Aktif" }}</center></td>
                                    <td class="text-center">

                                        <router-link :to="{ name:
    'pegawai.update', params: { id: pegawai.id } }" class="btn
    btn-sm btn-primary mr-1">
    EDIT</router-link>
    <button @click="deleteFromRow(id)" class="btn btn-sm btn-danger ml1">DELETE</button>

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
        let pegawais = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/pegawais')
                .then(response => {
                    //assign state posts with response data
                    pegawais.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/pegawais/${id}`)
                .then(() => {
                    const index = this.pegawais.findIndex(pegawai => pegawai.id === id)
                    if(index){
                        this.pegawais.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        //return
        return {
            pegawais,
            destroy
        }

    },

    methods: {
    deleteFromRow(id) {

        axios.delete(`http://127.0.0.1:8000/api/pegawais/${id}`)
                .then(() => {
                    const index = this.pegawais.findIndex(pegawai => pegawai.id === id)
                    if(index){
                        this.pegawais.splice(id, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })

      this.pegawais.splice(id, 1);
    }
}
        
}
</script>
<style>

</style>