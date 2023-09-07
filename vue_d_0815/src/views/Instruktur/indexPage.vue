<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Dashboard</h1>
        
        <h2>
  <span class="text-gradient"> Welcome, Admin!!</span></h2>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        
                        <div style="position: absolute; right: 0;">
                                    <label for="search">Search:</label>
                                  <input type="text" id="search" v-model="searchTerm">
                                     <button @click="search">Search</button>
                                    </div>

                        <router-link :to="{ name: 'instruktur.create' }" class="btn btn-md btn-success">TAMBAH INSTRUKTUR</router-link>
                        <button @click="resetTerlambat" class="btn-pretty">BULAN BARU</button>
                        <table class="table table-striped table-bordered mt4">
                            
                            <thead class="thead-dark">         
                                <tr>
                                    <th scope="col"><center>NAMA INSTRUKTUR</center></th>
                                    <th scope="col"><center>EMAIL</center></th>
                                    <th scope="col"><center>TELEPON</center></th>
                                    <th scope="col"><center>TERLAMBAT(menit)</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(instruktur, id) in instruktur" :key="id">
                                    <td><center>{{ instruktur.nama_instruktur }}</center></td>
                                    <td><center>{{ instruktur.email }}</center></td>
                                    <td><center>{{ instruktur.nomor_telepon }}</center></td>
                                    <td><center>{{ instruktur.terlambat }}</center></td>
                                    <td class="text-center">

                                        <router-link :to="{ name:
   'instruktur.update', params: { id: instruktur.id } }" class="btn
    btn-sm btn-primary mr-1">
    EDIT</router-link>
    <button @click="deleteFromRow(instruktur.id)" class="btn btn-sm btn-danger ml1">DELETE</button>

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

//Bootstrap
// import { MDBInput, MDBBtn, MDBIcon } from 'mdb-vue-ui-kit'
export default {
    //Bootstrap
// components: {
//       MDBInput,
//       MDBBtn,
//       MDBIcon
//     },
    setup() {
        // const searchQuery = ref('');

        //reactive state
        let instruktur = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/instruktur')
                .then(response => {
                    //assign state posts with response data
                    instruktur.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/instruktur/${id}`)
                .then(() => {
                    const index = this.instruktur.findIndex(instruktur => instruktur.id === id)
                    if(index){
                        this.instruktur.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        function resetTerlambat(){
            axios.post('http://127.0.0.1:8000/api/resetTerlambat')
            .then(() => {
                window.location.reload();
                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        // function watch(){

        //         axios.get('http://127.0.0.1:8000/api/instruktur',{searchQuery : this.searchQuery})

        // }

        //return
        return {
            instruktur,
            searchQuery : null,
            destroy,
            resetTerlambat,
        }

    },

    methods: {
        deleteFromRow(id) {

axios.delete(`http://127.0.0.1:8000/api/instruktur/${id}`)
        .then(() => {
            const index = this.instruktur.findIndex(instruktur => instruktur.id === id)
            if(index){
                this.instruktur.splice(id, 1)
            }
        
        }).catch(error => {
            console.log(error.response.data)
        })

this.instruktur.splice(id, 1);
}
}
        
}


</script>
<style>
.btn-pretty {
  border-radius: 10px;
  font-weight: bold;
  background-color: #005f5f; 
  color: white;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
  padding: 8px 8px;
  transition: background-color 0.3s ease;
}

.btn-pretty:hover {
  background-color: #0da00d; 
  cursor: pointer;
}

.btn-pretty:focus {
  outline: none;
  box-shadow: 0px 0px 6px rgba(143, 0, 255, 0.4);
}

@import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');
</style>