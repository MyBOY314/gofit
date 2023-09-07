<template>
    <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <h2>
  <span class="text-gradient">Welcome, Manager!!</span></h2>
    </div>
    
    <!-- Bootstrap -->
    <!-- <div>
        <MDBInput
    v-model="searchQuery"
    inputGroup
    :formOutline="false"
    wrapperClass="mb-3"
    placeholder="Search"
    aria-label="Search"
    aria-describedby="button-addon2"
  >
    <MDBBtn color="primary">
      <MDBIcon icon="search" />
    </MDBBtn>
  </MDBInput>
    </div> -->

    <div>

    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        
                        <div style="position: absolute; right: 0;">
                                    <label for="search">Search:</label>
                                  <input type="text" id="search" v-model="searchQuery"  @input="updateSearchQuery" placeholder="Enter jadwalUmum name">
                                     <button @click="getJadwalUmum(searchQuery)">Search</button>
                                    </div>

                        <router-link :to="{ name: 'jadwalUmum.create' }" class="btn btn-md btn-success">TAMBAH JADWAL</router-link>
                        <table class="table table-striped table-bordered mt4">
                            
                            <thead class="thead-dark">         
                                <tr>
                                    <th scope="col"><center>HARI</center></th>
                                    <th scope="col"><center>KELAS</center></th>
                                    <th scope="col"><center>INSTRUKTUR</center></th>
                                    <th scope="col"><center>JAM</center></th>
                                    <th scope="col"><center>TARIFF</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(jadwalUmum, id) in jadwalUmum" :key="id">
                                    <td><center>{{ jadwalUmum.hari }}</center></td>

                                    <td><center>{{ jadwalUmum.kelas.nama}}</center></td>
                                    <td><center>{{ jadwalUmum.instruktur.nama_instruktur }}</center></td>
                                    
                                    <td><center>{{ jadwalUmum.jam }}</center></td>
                                    <td><center>{{ jadwalUmum.kelas.tariff }}</center></td>
                                    <td class="text-center">

                <router-link :to="{ name:'jadwalUmum.update', params: { id: jadwalUmum.id } }" 
                class="btn btn-sm btn-primary mr-1"> EDIT</router-link>
    <button @click="deleteFromRow(jadwalUmum.id), location.reload();" class="btn btn-sm btn-danger ml1">DELETE</button>

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

//     computed: {
//   kelas() {
//     return this.$store.getters['kelas/getById'](this.jadwalUmum.kelas_id);
//   },
//   instruktur() {
//     return this.$store.getters['instruktur/getById'](this.jadwalUmum.instruktur_id);
//   },
// },

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
        let jadwalUmum = ref([])
        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/jadwalUmum')
                .then(response => {
                    //assign state posts with response data
                    jadwalUmum.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })
        
        // function search(id){
        //     axios.get(`http://127.0.0.1:8000/api/jadwalUmum/${id}`)
        //         .then(response => {
        //             //assign state posts with response data
        //             jadwalUmum.value = response.data.data
        //         }).catch(error => {
        //             console.log(error.response.data)
        //         })
        // }

        function destroy(id){
            axios.delete(`http://127.0.0.1:8000/api/jadwalUmum/${id}`)
                .then(() => {
                    const index = this.jadwalUmum.findIndex(jadwalUmum => jadwalUmum.id === id)
                    if(index){
                        this.jadwalUmum.splice(index, 1)
                    }
                
                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        // function watch(){

        //         axios.get('http://127.0.0.1:8000/api/jadwalUmum',{searchQuery : this.searchQuery})

        // }

        //return
        return {
            jadwalUmum,
            searchQuery : '',
            destroy,
            kelas,
            instruktur,

            // jadwalUmumName: '',
            // jadwalUmums: [],
            // jadwalUmumIndex: '',
        }

    },

//     //Mencoba Search
//     async mounted() {
//     // fetch jadwalUmums data from API endpoint
//     const response = await axios.get('http://127.0.0.1:8000/api/jadwalUmum/');
//     this.jadwalUmum.values= response.data;
//   },

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

    //  getjadwalUmum(searchQuery){
    //     console.log(searchQuery)
    //     axios.get(`http://127.0.0.1:8000/api/jadwalUmum/`+ searchQuery)
    //             .then(response => {
    //                 //assign state posts with response data
    //                 jadwalUmum.value = response.data.data

                    
    //             }).catch(error => {
    //                 console.log("MAMA aku takut OwO")
    //             })
    //  },

    // searchjadwalUmum() {
    //   const index = this.jadwalUmums.findIndex(jadwalUmum => jadwalUmum.name === this.searchTerm)
    //   console.log(index)
    // },

    // getjadwalUmumIndex() {
    //   const jadwalUmum = this.jadwalUmums.findIndex(jadwalUmum => jadwalUmum.nama_jadwalUmum === this.jadwalUmumName);
    //   if (jadwalUmum) {
    //     this.jadwalUmumIndex = this.jadwalUmums.indexOf(jadwalUmum);
    //   } else {
    //     this.jadwalUmumIndex = -1;
    //   }
    // },

    // //*

        deleteFromRow(id) {
axios.delete(`http://127.0.0.1:8000/api/jadwalUmum/${id}`)
        .then(() => {
            const index = this.jadwalUmum.findIndex(jadwalUmum => jadwalUmum.id === id)
            if(index){
                this.jadwalUmum.splice(id, 1)
            }
        
        }).catch(error => {
            console.log(error.response.data)
        })

this.jadwalUmum.splice(id, 1);
}

}

        
}


</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');
</style>