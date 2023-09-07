    <template>
        <div class="d-flex justify-content-between flex-wrap flex-mdnowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <h2>
    <span class="text-gradient">Welcome, Manager!!</span></h2>
        </div>

        <div>

        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 rounded shadow">
                        <div style="position: absolute; right: 0;">
                                        <label for="search">Search:</label>
                                    <input type="text" id="search" v-model="searchQuery"  @input="updateSearchQuery" placeholder="Enter jadwalUmum name">
                                        <button @click="getJadwalUmum(searchQuery)">Search</button>
                                        </div>
                        <div class="card-body">

                            <button @click="generateJadwal" class="btn btn-md btn-success">GENERATE JADWAL</button>
                             <div v-if="showError" class="error-popup">
                                <p>Jadwal Harian Minggu ini sudah ada [!]</p>
                                <center><button @click="dismissError">OK</button></center>
                                
                             </div>

                             <button @click="resetJadwal" class="btn btn-md btn-danger">RESET JADWAL</button>
                             <div v-if="showReset" class="error-popup">
                                <p>Jadwal Harian Minggu di RESET [!]</p>
                                <center><button @click="dismissReset">OK</button></center>
                                
                             </div>

                            <div v-if="showTable">
                            <table class="table table-striped table-bordered mt4">
                                
                                <thead class="thead-dark">         
                                    <tr>
                                        <th scope="col"><center>TANGGAL</center></th>
                                        <th scope="col"><center>HARI</center></th>
                                        <th scope="col"><center>KELAS</center></th>
                                        <th scope="col"><center>INSTRUKTUR</center></th>
                                        <th scope="col"><center>JAM</center></th>
                                        <th scope="col"><center>TARIFF</center></th>
                                        <th scope="col"><center>STATUS</center></th>
                                        <th scope="col"><center>Aksi</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr v-for="(jadwalUmum, id) in jadwalUmum" :key="id">
                                        <td v-if="jadwalUmum.hari === 'Senin'">
                                            Senin: {{ senins }}
                                            
                                        </td>
                                         <td v-else-if="jadwalUmum.hari === 'Selasa'">
                                            Selasa: {{ selasas }}
                                        </td>
                                        <td v-else-if="jadwalUmum.hari === 'Rabu'">
                                            Rabu: {{ rabus }}
                                        </td>
                                        <td v-else-if="jadwalUmum.hari === 'Kamis'">
                                            Kamis: {{ kamiss }}
                                        </td>
                                        <td v-else-if="jadwalUmum.hari === 'Jumat'">
                                            Jumat: {{ jumats }}
                                        </td>
                                        <td v-else-if="jadwalUmum.hari === 'Sabtu'">
                                            Sabtu: {{ sabtus }}
                                        </td>

                                        <td><center>{{ jadwalUmum.hari }}</center></td>

                                        <td><center>{{ jadwalUmum.kelas.nama}}</center></td>
                                        <td><center>{{ jadwalUmum.instruktur.nama_instruktur }}</center></td>
                                        
                                        <td><center>{{ jadwalUmum.jam }}</center></td>
                                        <td><center>{{ jadwalUmum.kelas.tariff }}</center></td>
                                        <td><center> MASUK </center></td>
                                        <td class="text-center">



        <button @click="deleteFromRow(jadwalUmum.id), location.reload();" class="btn btn-sm btn-danger ml1">LIBURKAN</button>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

<!-- <div>
    <ul>
      <li v-for="date in weekDates" :key="date">{{ date }}</li>
    </ul>
  </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </template>
    <script>
    import axios from 'axios'
    import { reactive, onMounted, ref } from 'vue'
    import { useRouter } from 'vue-router'


    export default {
        data() {
    return {
      weekDates: [],
      senin: [],
      showTable: localStorage.getItem('showTable') === 'true',
      showError: false,
      showReset: false,
    };
},
created() {
  window.addEventListener('beforeunload', () => {
    localStorage.setItem('showTable', this.showTable.toString());
  });
        // Get Monday dates of the current week
        this.senin = this.getWeekDates('Monday');
    },

    //Mencari tanggal seminggu penuh dari senin
    mounted() {
        const today = new Date();
        const dayOfWeek = today.getDay();
        const monday = new Date(today);
        monday.setDate(today.getDate() - dayOfWeek + 1); // Set to Monday of current week
        const sunday = new Date(today);
        sunday.setDate(today.getDate() - dayOfWeek + 7); // Set to Sunday of current week
        const weekDates = [];
        for (let date = new Date(monday); date <= sunday; date.setDate(date.getDate() + 1)) {
        weekDates.push(new Date(date).toISOString().slice(0, 10)); // Add ISO string format of date to array
        }
        this.weekDates = weekDates;
    },
        setup() {

            const getTanggal = (targetDay) => {
      const dates = [];
      const startOfWeek = moment().startOf('isoWeek');
      for (let i = 0; i < 7; i++) {
        const date = moment(startOfWeek).add(i, 'days');
        const day = date.format('dddd').toLowerCase();
        if (day === targetDay.toLowerCase()) {
          dates.push(date.format('D'));
        } else {
          dates.push('');
        }
      }
      return dates;
    };
    
    //Fungsi untuk mendapatkan tanggal di jadwalHarian
const    getWeekDate = (targetDay) => {
    let resultDate = '';
  const startOfWeek = moment().isoWeekday('Monday').add(7, 'days');
  for (let i = 0; i < 7; i++) {
    const date = moment(startOfWeek).add(i, 'days');
    const day = date.format('dddd').toLowerCase();
    if (day === targetDay.toLowerCase()) {
      resultDate = date.format('YYYY-MM-DD');
      break;
    }
  }
  return resultDate;
}

    const senins = getWeekDate('Monday');
    const selasas = getWeekDate('Tuesday');
    const rabus = getWeekDate('Wednesday');
    const kamiss = getWeekDate('Thursday');
    const jumats = getWeekDate('Friday');
    const sabtus = getWeekDate('Saturday');

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

            //Jadwal Harian = JadwalUmum

            //state JadwalUmum
        const jadwalUmums = reactive({
            jadwalUmum: '',
            hari: '',
            kelas_id: '',
            instruktur_id: '',
            jam: '',
        })

//state validation
const validation = ref([])
        //vue router
        const router = useRouter()
        
        //method store
        function store() {
            let tanggals = jadwalUmums.hari
            let jadwal_umum_ids = jadwalUmums.jadwalUmum
            let statuss = jadwalUmums.status
            axios.put(`http://localhost:8000/api/jadwalHarian/}`, {
            tanggal: tanggals,
            jadwal_umum_id: jadwal_umum_ids,
            status: statuss,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'jadwalHarian.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }

            //return
            return {
                jadwalUmum,
                jadwalUmums,
                // jadwalHarian,
                searchQuery : '',
                kelas,
                instruktur,

                //JadwalHarian Tanggal,
                senins,
                selasas,
                rabus,
                kamiss, 
                jumats,
                sabtus, 
                getTanggal,

                // theDate,
                destroy,
                store,
            }

        },


        methods: {
            toggleStatus(jadwal) {
      jadwal.status = jadwal.status === 'ACTIVE' ? 'LIBUR' : 'ACTIVE';
    },
            
            generateJadwal() {
      if (this.showTable) {
        this.showError = true
      } else {
        // code to generate jadwal and show table
        this.showTable = true
      }
    },
    resetJadwal() {
        if (this.showReset) {
        this.showReset = true
      } else {
        this.showTable = false
      }
    },
    dismissReset() {
        this.showReset = false;
    },
    dismissError() {
      this.showError = false
    },
  

            getWeekDates(targetDay) {
  const dates = [];
  const startOfWeek = moment().startOf('isoWeek');
  for (let i = 0; i < 7; i++) {
    const date = moment(startOfWeek).add(i, 'days');
    const day = date.format('dddd').toLowerCase();
    if (day === targetDay.toLowerCase()) {
      dates.push(date.format('YYYY-MM-DD'));
    } else {
      dates.push('');
    }
  }
  return dates;
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


//Import
import moment from 'moment';

    </script>
    <style>
    .error-popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #ffcccc;
  padding: 20px;
  border: 2px solid #ff0000;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  font-family: Arial, sans-serif;
  font-size: 16px;
  color: #333;
  text-align: center;
}

    @import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');
    </style>