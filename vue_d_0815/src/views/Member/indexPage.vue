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
                        
                        <!-- <div style="position: absolute; right: 0;">
                                    <label for="search">Search:</label>
                                  <input type="text" id="search" v-model="searchQuery"  @input="updateSearchQuery" placeholder="Enter member name">
                                     <button @click="getMember(searchQuery)">Search</button>
                                    </div> -->

                        <router-link :to="{ name: 'member.create' }" class="btn btn-md btn-success">TAMBAH MEMBER</router-link>
                        <table class="table table-striped table-bordered mt4">
                            
                            <thead class="thead-dark">         
                                <tr>
                                    <th scope="col"><center>NOMOR MEMBER</center></th>
                                    <th scope="col"><center>NAMA MEMBER</center></th>
                                    <th scope="col"><center>EMAIL</center></th>
                                    <th scope="col"><center>TELEPON</center></th>
                                    <th scope="col"><center>TANGGAL LAHIR</center></th>
                                    <th scope="col"><center>EXPIRED DATE</center></th>
                                    <th scope="col"><center>DEPOSIT KELAS</center></th>
                                    <th scope="col"><center>STATUS</center></th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(member, id) in member" :key="id">
                            
                                    <td><center>{{ formatDate(member.created_at) }}.{{ member.id }}</center></td>
                                    <td><center>{{ member.nama_member }}</center></td>
                                    <td><center>{{ member.email }}</center></td>
                                    <td><center>{{ member.nomor_telepon }}</center></td>
                                    <td><center>{{ member.tanggal_lahir }}</center></td>
                                    <td><center>{{ member.expired_date }}</center></td>
                                    <td><center>{{ member.depositKelas }}</center></td>
                                    <td scope="col" v-if="isDateLessThan(member.expired_date, currentDate)">
                                        <center>EXPIRED
                                            <router-link :to="{ name:'member.aktivasi', params: { id: member.id } }" 
                                            class="btn btn-sm btn-primary mr-1 btn-pretty">AKTIVASI</router-link>
                                        </center></td>
                                    <td scope="col" v-else><center>ACTIVE</center></td>
                                    <td class="text-center">

                <router-link :to="{ name:'member.update', params: { id: member.id } }" 
                class="btn btn-sm btn-primary mr-1"> EDIT</router-link>
    <button @click="deleteFromRow(member.id)" class="btn btn-sm btn-danger ml1">DELETE</button>

    <router-link :to="{ name:'member.card', params: { id: member.id } }" 
                class="btn btn-sm btn-warning mr-1">CARD</router-link>

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
import { onMounted, ref, computed } from 'vue'

export default {
    setup() {
    const member = ref([]);
    const currentDate =ref('');

    onMounted(() => {
      axios
        .get('http://127.0.0.1:8000/api/member')
        .then((response) => {
          member.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    const formatDate = (timestamp) => {
      const date = new Date(timestamp);
      const month = ('0' + (date.getMonth() + 1)).slice(-2);
      const year = date.getFullYear().toString().slice(-2);
      return `${month}.${year}`;
    };

    const deleteFromRow = (id) => {
      axios
        .delete(`http://127.0.0.1:8000/api/member/${id}`)
        .then(() => {
          const index = member.value.findIndex((member) => member.id === id);
          if (index !== -1) {
            member.value.splice(index, 1);
          }
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    };

    const isDateLessThan = computed(() => {
      return (date1, date2) => {
        return new Date(date1) < new Date(date2);
      };
    });

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

    return {
      member,
      currentDate,
      formatDate,
      deleteFromRow,
      isDateLessThan,
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