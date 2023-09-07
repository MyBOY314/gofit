<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
              <input type="text" id="search" v-model="searchQuery" @input="updateSearchQuery" placeholder="Enter depositKelas name">
              <button @click="getDepositKelas(searchQuery)">Search</button>
            </div>

            <router-link :to="{ name: 'depositKelas.create' }" class="btn btn-md btn-success">TAMBAH DEPOSIT</router-link>

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
                    <center>NAMA KELAS</center>
                  </th>
                  <th scope="col">
                    <center>NAMA MEMBER</center>
                  </th>
                  <th scope="col">
                    <center>KASIR</center>
                  </th>
                  <th scope="col">
                    <center>EXPIRED DATE</center>
                  </th>
                  <th scope="col">
                    <center>STATUS</center>
                  </th>
                  <th scope="col">
                    <center>Aksi</center>
                  </th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(depositKelas, id) in depositKelas" :key="id">
                  <td><center>{{ formatDate(depositKelas.created_at) }}.{{ depositKelas.id }}</center></td>
                  <td scope="col" v-if="isDateLessThan(depositKelas.expired_date, currentDate)">
                    <center>0</center>
                  </td>
                  <td scope="col" v-else>
                    <center>{{ depositKelas.jumlah_deposit }}</center>
                  </td>
                  <td><center>{{ depositKelas.kelas.nama}}</center></td>
                  <td><center>{{ depositKelas.member.nama_member}}</center></td>
                  <td><center>{{ depositKelas.pegawai.nama }}</center></td>
                  <td><center>{{ depositKelas.expired_date }}</center></td>
                  <td scope="col" v-if="isDateLessThan(depositKelas.expired_date, currentDate)">
                    <center>EXPIRED</center>
                  </td>
                  <td scope="col" v-else>
                    <center>ACTIVE</center>
                  </td>
                  <td class="text-center">
                    <router-link :to="{ name:'depositKelas.struk', params: { id: depositKelas.id } }" class="btn btn-sm btn-primary mr-1 btn-pretty">STRUK</router-link>
                    <button @click="deleteFromRow(depositKelas.id)" class="btn btn-sm btn-danger ml1">DELETE</button>
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
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';

export default {
  setup() {
    // Reactive state
    const depositKelas = ref([]);
    const member = ref([]);
    const pegawai = ref([]);
    const kelas = ref([]);
    const searchQuery = ref('');
    const currentDate = ref('');
    const formatDate = (timestamp) => {
      const date = new Date(timestamp);
      const month = ('0' + (date.getMonth() + 1)).slice(-2);
      const year = date.getFullYear().toString().slice(-2);
      return `${month}.${year}`;
    };

    // Mounted
    onMounted(() => {
      // Get depositKelas from Laravel Backend
      axios
        .get('http://127.0.0.1:8000/api/depositKelas')
        .then((response) => {
          depositKelas.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });

      // Get member from Laravel Backend
      axios
        .get('http://localhost:8000/api/member')
        .then((response) => {
          member.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });

      // Get pegawai from Laravel Backend
      axios
        .get('http://localhost:8000/api/pegawais')
        .then((response) => {
          pegawai.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });

      // Get kelas from Laravel Backend
      axios
        .get('http://127.0.0.1:8000/api/kelas')
        .then((response) => {
          kelas.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    // Computed property
    const isDateLessThan = computed(() => {
      return (date1, date2) => {
        return new Date(date1) < new Date(date2);
      };
    });

    // Methods
    function destroy(id) {
      axios
        .delete(`http://127.0.0.1:8000/api/depositKelas/${id}`)
        .then(() => {
          const index = depositKelas.value.findIndex((deposit) => deposit.id === id);
          if (index !== -1) {
            depositKelas.value.splice(index, 1);
          }
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    }

    function updateSearchQuery(event) {
      searchQuery.value = event.target.value;
    }

    function deleteFromRow(id, index) {
      axios
        .delete(`http://127.0.0.1:8000/api/depositKelas/${id}`)
        .then(() => {
          depositKelas.value.splice(index, 1);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    }

    // Mounted
    const options = {
  timeZone: 'Asia/Jakarta',
  year: 'numeric',
  month: '2-digit',
  day: '2-digit'
};

const currentDateValue = new Date().toLocaleString('en-US', options);
const [month, day, year] = currentDateValue.split('/');
const formattedDate = `${year}-${month}-${day}`;
currentDate.value = currentDateValue;

console.log(formattedDate);

    // Return reactive data and methods
    return {
      depositKelas,
      member,
      pegawai,
      kelas,

      searchQuery,
currentDate,
formatDate,
isDateLessThan,
destroy,
updateSearchQuery,
deleteFromRow,
};
},
};
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