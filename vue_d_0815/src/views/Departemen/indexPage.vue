<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <router-link :to="{ name: 'departemen.create' }" class="btn btn-md btn-success">TAMBAH DEPARTEMEN</router-link>
                        <table class="table table-striped table-bordered mt4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><center>NAMA DEPARTEMEN</center></th>
                                    <th scope="col"><center>NAMA MANAGER</center></th>
                                    <th scope="col"><center>JUMLAH PEGAWAI</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(departemen, id) in departemens" :key="id">
                                    <td><center>{{ departemen.nama_departemen }}</center></td>
                                    <td><center>{{ departemen.nama_manager }}</center></td>
                                    <td><center>{{ departemen.jumlah_pegawai }}</center></td>
                                    <td class="text-center">

                                        <router-link :to="{ name:
    'departemen.update', params: { id: departemen.id } }" class="btn
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
        let departemens = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/departemens')
                .then(response => {
                    //assign state posts with response data
                    departemens.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/departemens/${id}`)
                .then(() => {
                    const index = this.departemens.findIndex(departemen => departemen.id === id)
                    if(index){
                        this.departemens.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        //return
        return {
            departemens,
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