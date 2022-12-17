<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <router-link :to="{ name: 'pengguna.create' }" class="btn btn-md btn-success">TAMBAH PENGGUNA</router-link>
                        <table class="table table-striped table-bordered mt4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><center>NAMA PENGGUNA</center></th>
                                    <th scope="col"><center>EMAIL</center></th>
                                    <th scope="col"><center>TELEPON</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pengguna, id) in pengguna" :key="id">
                                    <td><center>{{ pengguna.nama }}</center></td>
                                    <td><center>{{ pengguna.email }}</center></td>
                                    <td><center>{{ pengguna.telepon }}</center></td>
                                    <td class="text-center">

                                        <router-link :to="{ name:
    'pengguna.update', params: { id: pengguna.id } }" class="btn
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
        let pengguna = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/pengguna')
                .then(response => {
                    //assign state posts with response data
                    pengguna.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/pengguna/${id}`)
                .then(() => {
                    const index = this.pengguna.findIndex(pengguna => pengguna.id === id)
                    if(index){
                        this.pengguna.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        //return
        return {
            pengguna,
            destroy
        }

    },

    methods: {
        deleteFromRow(id) {

axios.delete(`http://127.0.0.1:8000/api/pengguna/${id}`)
        .then(() => {
            const index = this.pengguna.findIndex(pengguna => pengguna.id === id)
            if(index){
                this.pengguna.splice(id, 1)
            }
        
        }).catch(error => {
            console.log(error.response.data)
        })

this.pengguna.splice(id, 1);
}
}
        
}
</script>
<style>

</style>