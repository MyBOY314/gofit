<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <router-link :to="{ name: 'proyek.create' }" class="btn btn-md btn-success">TAMBAH PROYEK</router-link>
                        <table class="table table-striped table-bordered mt4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><center>NAMA PROYEK</center></th>
                                    <th scope="col"><center>DEPARTEMEN</center></th>
                                    <th scope="col"><center>WAKTU MULAI</center></th>
                                    <th scope="col"><center>WAKTU SELESAI</center></th>
                                    <th scope="col"><center>STATUS</center></th>
                                    <th scope="col"><center>AKSI</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(proyek, id) in proyeks" :key="id">
                                    <td><center>{{ proyek.nama_proyek}}</center></td>
                                    <td><center>{{ proyek.nama_departemen }}</center></td>
                                    <td><center>{{ proyek.waktu_mulai }}</center></td>
                                    <td><center>{{ proyek.waktu_selesai }}</center></td>
                                    <td><center>{{ proyek.status ? "Tidak Aktif" : "Aktif" }}</center></td>
                                    <td class="text-center">

                                        <router-link :to="{ name:
    'proyek.update', params: { id: proyek.id } }" class="btn
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
        let proyeks = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/proyeks')
                .then(response => {
                    //assign state posts with response data
                    proyeks.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/proyeks/${id}`)
                .then(() => {
                    const index = this.proyeks.findIndex(proyek => proyek.id === id)
                    if(index){
                        this.proyeks.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        //return
        return {
            proyeks,
            destroy
        }

    },

    methods: {
    deleteFromRow(id) {

        axios.delete(`http://127.0.0.1:8000/api/proyeks/${id}`)
                .then(() => {
                    const index = this.proyeks.findIndex(proyek => proyek.id === id)
                    if(index){
                        this.proyeks.splice(id, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })

      this.proyeks.splice(id, 1);
    }
}
        
}
</script>
<style>

</style>