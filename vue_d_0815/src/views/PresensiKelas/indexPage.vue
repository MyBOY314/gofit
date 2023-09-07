<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <h2>
  <span class="text-gradient">Welcome, Kasir!!</span></h2>

    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        
                        <div style="position: absolute; right: 0;">
                                    <label for="search">Search:</label>
                                  <input type="text" id="search" v-model="searchQuery"  @input="updateSearchQuery" placeholder="Enter presensiGym name">
                                     <button @click="getpresensiGym(searchQuery)">Search</button>
                                    </div>

                        <router-link :to="{ name: 'presensiGym.create' }" class="btn btn-md btn-success">TAMBAH JADWAL</router-link>
                        <table class="table table-striped table-bordered mt4">
                            
                            <thead class="thead-dark">         
                                <tr>
                                    <th scope="col"><center>NOMOR MEMBER</center></th>
                                    <th scope="col"><center>TANGGAL</center></th>
                                    <th scope="col"><center>NAMA MEMBER</center></th>
                                    <th scope="col"><center>SESI</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(presensiGym, id) in presensiGym" :key="id">
                                    <td><center>{{ formatDate(presensiGym.booking_gym.member.created_at) }}.{{ presensiGym.booking_gym.member.id }}</center></td>
                                    <td><center>{{ presensiGym.booking_gym.tanggal }}</center></td>
                                    <td><center>{{ presensiGym.booking_gym.member.nama_member }}</center></td>
                                    <td><center>{{ presensiGym.booking_gym.gym.slot_waktu }}</center></td>
                                    <td><center>
                                    <span v-if="presensiGym.status === 1" class="confirmed-status">CONFIRMED</span>
                                    <span v-else class="unconfirmed-status">UNCONFIRMED</span>
                                    </center></td>

                                    <td class="text-center">

                <router-link :to="{ name:'presensiGym.update', params: { id: presensiGym.id } }" 
                class="btn btn-sm btn-primary mr-1"> EDIT</router-link>
    <button @click="deleteFromRow(presensiGym.id), location.reload();" class="btn btn-sm btn-danger ml1">DELETE</button>

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
let kelas = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/kelas')
                .then(response => {
                    //assign state posts with response data
                    kelas.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //reactive state
let instruktur = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/instruktur')
                .then(response => {
                    //assign state posts with response data
                    instruktur.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //reactive state
        let presensiGym = ref([])
        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/presensiGym')
                .then(response => {
                    //assign state posts with response data
                    presensiGym.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //reactive state
        let bookingGym = ref([])
        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/bookingGym')
                .then(response => {
                    //assign state posts with response data
                    bookingGym.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //reactive state
        let gym = ref([])
        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/gym')
                .then(response => {
                    //assign state posts with response data
                    gym.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/presensiGym/${id}`)
                .then(() => {
                    const index = this.presensiGym.findIndex(presensiGym => presensiGym.id === id)
                    if(index){
                        this.presensiGym.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }
        return {
            bookingGym,
            presensiGym,
            gym,
            searchQuery : '',
            destroy,
            kelas,
            instruktur,
        }

    },

    methods: {

        formatDate(timestamp) {
      const date = new Date(timestamp);
      const month = ("0" + (date.getMonth() + 1)).slice(-2);
      const year = date.getFullYear().toString().slice(-2);
      return `${month}.${year}`;
    },

    // //Mencoba Search
    updateSearchQuery(event) {
      this.searchQuery = event.target.value
    },

        deleteFromRow(id) {
axios.delete(`http://127.0.0.1:8000/api/presensiGym/${id}`)
        .then(() => {
            const index = this.presensiGym.findIndex(presensiGym => presensiGym.id === id)
            if(index){
                this.presensiGym.splice(id, 1)
            }
        
        }).catch(error => {
            console.log(error.response.data)
        })

this.presensiGym.splice(id, 1);
}

}

        
}


</script>
<style>

.confirmed-status {
  color: green;
  font-weight: bold;
  text-transform: uppercase;
  background-color: #e1f3dc;
  padding: 6px 12px;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease;
}

.confirmed-status:hover {
  background-color: #c6e6b8;
}

.unconfirmed-status {
  color: red;
  font-weight: bold;
  text-transform: uppercase;
  background-color: #fddddd;
  padding: 6px 12px;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease;
}

.unconfirmed-status:hover {
  background-color: #f9c0c0;
}

@import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');
</style>