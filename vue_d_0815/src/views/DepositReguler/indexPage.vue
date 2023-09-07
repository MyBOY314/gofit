<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1>
      <h2>
        <span class="text-gradient">Welcome, Kasir!!</span>
      </h2>
    </div>
  
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-0 rounded shadow">
            <div class="card-body">
  
              <div style="position: absolute; right: 0;">
                <label for="search">Search:</label>
                <input type="text" id="search" v-model="searchQuery" @input="updateSearchQuery" placeholder="Enter depositReguler name">
                <button @click="getdepositReguler(searchQuery)">Search</button>
              </div>
  
              <router-link :to="{ name: 'depositReguler.create' }" class="btn btn-md btn-success">TAMBAH DEPOSIT</router-link>
  
              <table class="table table-striped table-bordered mt4">
  
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">
                      <center>NOMOR STRUK</center>
                    </th>
                    <th scope="col">
                      <center>JUMLAH DEPOSIT</center>
                    </th>
                    <th scope="col">
                      <center>NAMA MEMBER</center>
                    </th>
                    <th scope="col">
                      <center>KASIR</center>
                    </th>
                    <th scope="col">
                      <center>Aksi</center>
                    </th>
                  </tr>
                </thead>
  
                <tbody>
                    <tr v-for="(depositReguler, id) in depositReguler" :key="id">
                        <td><center>{{ formatDate(depositReguler.created_at) }}.{{ depositReguler.id }}</center></td>
                                    <td><center>Rp. {{ depositReguler.deposit_uang }}.00</center></td>
                                    <td><center>{{ depositReguler.member.nama_member}}</center></td>
                                    <td><center>{{ depositReguler.pegawai.nama }}</center></td>
                                    
                                    <td class="text-center">

                <router-link :to="{ name:'depositReguler.struk', params: { id: depositReguler.id } }" 
                class="btn btn-sm btn-primary mr-1 btn-pretty">STRUK</router-link>
    <button @click="deleteFromRow(depositReguler.id), location.reload();" class="btn btn-sm btn-danger ml1">DELETE</button>

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
        let depositReguler = ref([])

        
        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/depositReguler')
                .then(response => {
                    //assign state posts with response data
                    depositReguler.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        let member = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/member')
                .then(response => {
                    //assign state posts with response data
                    member.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //reactive state
let pegawai = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/pegawais')
                .then(response => {
                    //assign state posts with response data
                    pegawai.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })
        

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/depositReguler/${id}`)
                .then(() => {
                    const index = this.depositReguler.findIndex(depositReguler => depositReguler.id === id)
                    if(index){
                        this.depositReguler.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        //return
        return {
            depositReguler,
            member,
            pegawai,
            searchQuery : '',
            destroy,

            currentDate: '',
        }

    },

    computed: {
    isDateLessThan() {
      return (date1, date2) => {
        return new Date(date1) < new Date(date2);
      }
    }
  },

    mounted() {
    const options = {
      timeZone: 'Asia/Jakarta',
      year: 'numeric',
      month: '2-digit',
      day: '2-digit'
    };
    const currentDate = new Date().toLocaleString('id-ID', options);
    this.currentDate = currentDate;
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
axios.delete(`http://127.0.0.1:8000/api/depositReguler/${id}`)
        .then(() => {
            const index = this.depositReguler.findIndex(depositReguler => depositReguler.id === id)
            if(index){
                this.depositReguler.splice(id, 1)
            }
        
        }).catch(error => {
            console.log(error.response.data)
        })

this.depositReguler.splice(id, 1);
}

}

        
}


</script>
<style>
.btn-pretty {
  border-radius: 10px;
  font-weight: bold;
  background-color: #8f00ff;
  color: white;
  text-shadow: 1px 1px 1px black;
}

@import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');
</style>