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

                        <router-link :to="{ name: 'presensiGym.create' }" class="btn btn-md btn-success">TAMBAH PRESENSI GYM </router-link>
                        <button @click="showConfirmed = true" class="btn-pretty">Show Unconfirmed</button>
                        <button @click="showConfirmed = false" class="btn-pretty">Show All</button>
                        <table class="table table-striped table-bordered mt4">
                            
                            <thead class="thead-dark">         
                                <tr>
                                    <th scope="col"><center>NOMOR MEMBER</center></th>
                                    <th scope="col"><center>TANGGAL</center></th>
                                    <th scope="col"><center>NAMA MEMBER</center></th>
                                    <th scope="col"><center>SESI</center></th>
                                    <th scope="col"><center>STATUS</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(presensiGym, id) in filteredPresensiGym" :key="id">
                                    <td><center>{{ formatDate(presensiGym.booking_gym.member.created_at) }}.{{ presensiGym.booking_gym.member.id }}</center></td>
                                    <td><center>{{ presensiGym.booking_gym.tanggal }}</center></td>
                                    <td><center>{{ presensiGym.booking_gym.member.nama_member }}</center></td>
                                    <td><center>{{ presensiGym.booking_gym.gym.slot_waktu }}</center></td>
                                    <td><center>
                                    <span v-if="presensiGym.status === 1" class="confirmed-status">CONFIRMED</span>
                                    <span v-else class="unconfirmed-status">UNCONFIRMED</span>
                                    </center></td>

                                    <td class="text-center">
        
        <span v-if="presensiGym.status === 0" >
        <button @click="confirmIzinInstruktur(presensiGym.id)" class="confirm-button">Confirm</button>
        <button @click="cancelIzinInstruktur(presensiGym.id)" class="cancel-button">CANCEL</button>
    </span>
    <span v-else>
        <center>
    <router-link :to="{ name:'presensiGym.struk', params: { id: presensiGym.id } }" 
                class="btn btn-sm btn-warning mr-1">STRUK</router-link>
                </center>
            </span>

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
            searchQuery : '',
            destroy,
        }

    },

    computed: {
    filteredPresensiGym() {
      if (this.showConfirmed) {
        return this.presensiGym.filter(
          (presensiGym) => presensiGym.status === 0
        );
      } else {
        return this.presensiGym;
      }
    },
  },

    methods: {

        confirmIzinInstruktur(id) {
      axios
        .put(`http://localhost:8000/api/presensiGym/${id}`, { status: 1 })
        .then(() => {
          // Update the izinInstruktur.konfirmasi value in the local array
          const index = this.presensiGym.findIndex(item => item.id === id);

          if (index !== -1) {
            this.presensiGym[index].status = 1;
          }
          window.location.reload();
        })
        .catch(error => {
          console.log(error.response.data);
        });
        
    },

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
.toastify-success {
  color: green;
  font-weight: bold;
}

.toastify-error {
  color: red;
  font-weight: bold;
}

.toastify-notification {
  border-radius: 4px;
  font-family: Arial, sans-serif;
}
/* table data */
.table-date {
  font-weight: bold;
  color: #333;
  font-size: 16px;
}

.table-time {
  color: #555;
  font-size: 14px;
}

.table-description {
  font-style: italic;
  color: #3f3e3e;
  font-size: 14px;
}

.table-instructor {
  text-transform: uppercase;
  font-weight: bold;
  color: #444;
  letter-spacing: 1px;
  font-size: 14px;
}

.table-class {
  color: #666;
  font-weight: bold;
  text-decoration: underline;
  font-size: 14px;
}
/* table */
.table {
  width: 100%;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 12px;
  text-align: center;
}

.table thead th {
  background-color: #343a40;
  color: #fff;
}

.table tbody tr:nth-child(even) {
  background-color: #f8f9fa;
}

.table-striped tbody tr:nth-child(odd) {
  background-color: #f8f9fa;
}

.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th {
  background-color: #343a40;
  color: #fff;
}

.table-hover tbody tr:hover {
  background-color: #f2f2f2;
}

.table-hover tbody td:hover {
  background-color: #f2f2f2;
}

.table-hover tbody tr:hover > td {
  cursor: pointer;
}

.table-hover tbody td:hover > span {
  color: #343a40;
}

.table-hover tbody td .confirmed-status:hover {
  background-color: #c6e6b8;
}

.table-hover tbody td .unconfirmed-status:hover {
  background-color: #f9c0c0;
}

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

.confirm-button {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.confirm-button:hover {
  background-color: #45a049;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transform: translateY(-1px);
}

.cancel-button {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.cancel-button:hover {
  background-color: #c82333;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transform: translateY(-1px);
}

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