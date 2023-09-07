<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <h2>
  <span class="text-gradient">Welcome, Manager!!</span></h2>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        
                        <!-- <div style="position: absolute; right: 0;">
                                    <label for="search">Search:</label>
                                  <input type="text" id="search" v-model="searchQuery"  @input="updateSearchQuery" placeholder="Enter jadwal_umum_id name">
                                     <button @click="getjadwal_umum_id(searchQuery)">Search</button>
                                    </div> -->

                        <!-- <router-link :to="{ name: 'jadwal_umum_id.create' }" class="btn btn-md btn-success">TAMBAH JADWAL</router-link> -->
                        <button @click="showConfirmed = true" class="btn-pretty">Show Unconfirmed</button>
    <button @click="showConfirmed = false" class="btn-pretty">Show All</button>
                        <table class="table table-striped table-bordered mt-4">
  <thead class="thead-dark">
    <tr>
      <th scope="col">HARI</th>
      <th scope="col">SESI</th>
      <th scope="col">KETERANGAN</th>
      <th scope="col">INSTRUKTUR</th>
      <th scope="col">KELAS</th>
      <th scope="col">KONFIRMASI</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(izinInstruktur, id) in filteredIzinInstruktur" :key="id">
      <td class="table-date">{{ izinInstruktur.tanggal }}</td>
      <td class="table-time">{{ izinInstruktur.jadwal_umum.jam }}</td>
      <td class="table-description">{{ izinInstruktur.keterangan }}</td>
      <td class="table-instructor">{{ izinInstruktur.jadwal_umum.instruktur.nama_instruktur }}</td>
      <td class="table-class">{{ izinInstruktur.jadwal_umum.kelas.nama }}</td>
      <td>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <span v-if="izinInstruktur.konfirmasi === 1" class="confirmed-status">CONFIRMED</span>
        <span v-else class="unconfirmed-status">UNCONFIRMED</span>
      </td>
      <td class="text-center">
        <button @click="confirmIzinInstruktur(izinInstruktur.id)" class="confirm-button">Confirm</button>
        <!-- <button @click="cancelIzinInstruktur(izinInstruktur.id)" class="cancel-button">CANCEL</button> -->
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
import { onMounted, ref, getCurrentInstance } from 'vue'
// import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css';


export default {

  data() {
    return {
      showConfirmed: false,
    };
  },
  computed: {
    filteredIzinInstruktur() {
      if (this.showConfirmed) {
        return this.izinInstruktur.filter(
          (izinInstruktur) => izinInstruktur.konfirmasi === 0
        );
      } else {
        return this.izinInstruktur;
      }
    },
  },
//     props: {
//     izinInstruktur: {
//       type: Array,
//       required: true,
//     },
// },
    setup() {
        // console.log('jadwal_umum_id:', props.izinInstruktur[0].jadwal_umum_id);
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
        let jadwal_umum_id = ref([])
        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/jadwalUmum')
                .then(response => {
                    //assign state posts with response data
                    jadwal_umum_id.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //reactive state
        let izinInstruktur = ref([])
        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/izinInstruktur')
                .then(response => {
                    //assign state posts with response data
                    izinInstruktur.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        function destroy(id){
    axios.delete(`http://127.0.0.1:8000/api/izinInstruktur/${id}`)
        .then(() => {
            const index = izinInstruktur.value.findIndex(izinInstruktur => izinInstruktur.id === id)
            if(index){
                izinInstruktur.value.splice(index, 1)
            }
        
        }).catch(error => {
            console.log(error.response.data)
        })
}

        //return
        return {
            jadwal_umum_id,
            searchQuery : '',
            destroy,
            kelas,
            instruktur,
            izinInstruktur,
        }

    },

    methods: {

        confirmIzinInstruktur(id) {
      axios
        .put(`http://localhost:8000/api/izinInstruktur/${id}`, { konfirmasi: 1 })
        .then(() => {
          // Update the izinInstruktur.konfirmasi value in the local array
          const index = this.izinInstruktur.findIndex(item => item.id === id);

    //       if (this.izinInstruktur[index].konfirmasi === 1) {
    //   Toastify({
    //     text: 'DATA IS ALREADY CONFIRMED',
    //     backgroundColor: '#c6e6b8',
    //     className: 'toastify-success',
    //   }).showToast();
    // } else {
    //   Toastify({
    //     text: 'DATA IS CONFIRMED',
    //     backgroundColor: '#f9c0c0',
    //     className: 'toastify-error',
    //   }).showToast();
    // }

          if (index !== -1) {
            this.izinInstruktur[index].konfirmasi = 1;
          }
          window.location.reload();
        })
        .catch(error => {
          console.log(error.response.data);
        });
        
    },

    cancelIzinInstruktur(id) {
  axios
    .put(`http://localhost:8000/api/izinInstruktur/${id}`, { konfirmasi: 0 })
    .then(() => {
      // Update the izinInstruktur.konfirmasi value in the local array
      const index = this.izinInstruktur.findIndex(item => item.id === id);

    //   if (this.izinInstruktur[index].konfirmasi === 0) {
    //     Toastify({
    //       text: 'DATA IS CANCELED',
    //       backgroundColor: '#f9c0c0',
    //       className: 'toastify-error',
    //     }).showToast();
    //   }

      if (index !== -1) {
        this.izinInstruktur[index].konfirmasi = 0;
      }
      window.location.reload();
    })
    .catch(error => {
      console.log(error.response.data);
    });
},


  mounted() {
    const instance = getCurrentInstance();
    this.confirmIzinInstruktur = instance.ctx.confirmIzinInstruktur;
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
axios.delete(`http://127.0.0.1:8000/api/izinInstruktur/${id}`)
        .then(() => {
            const index = this.izinInstruktur.findIndex(izinInstruktur => izinInstruktur.id === id)
            if(index){
                this.izinInstruktur.splice(id, 1)
            }
        
        }).catch(error => {
            console.log(error.response.data)
        })

this.izinInstruktur.splice(id, 1);
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