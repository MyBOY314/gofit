<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>UPDATE POST</h4>
                        <hr>
                        <form @submit.prevent="update">
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Tanggal Peminjaman</label>
                                <input class="form-control" type="date" v-model="peminjaman.waktu_mulai"
                                    placeholder="Masukkan Tanggal Mulai">
                                <!-- validation -->
                                <div v-if="validation.waktu_mulai" class="mt-2 alert alert-danger">
                                    {{
                                            validation.waktu_mulai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Durasi Peminjaman</label>
                                <input class="form-control" v-model="peminjaman.durasi_peminjaman"
                                    placeholder="Masukkan Durasi">
                                <!-- validation -->
                                <div v-if="validation.durasi_peminjaman" class="mt-2 alert alert-danger">
                                    {{
                                            validation.durasi_peminjaman[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Buku</label>
                                    <select class="select form-control" v-model="peminjaman.buku" placeholder="Pilih Buku">
                                    <option disabled selected style="display: ruby;">Pilih Buku</option>
                                    <option v-for="buku in buku" :key="buku.id" :value="buku.id">
                                    {{ buku.nama }}
                                    </option>
                                </select>
                                <!-- validation -->
                                <div v-if="validation.buku" class="mt-2 alert alert-danger">
                                    {{
                                            validation.buku[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Pengguna</label>
                                <select class="select form-control" v-model="peminjaman.pengguna" placeholder="Pilih Buku">
                                    <option disabled selected style="display: ruby;">Pilih Pengguna</option>
                                    <option v-for="pengguna in pengguna" :key="pengguna.id" :value="pengguna.id">
                                    {{ pengguna.nama }}
                                    </option>
                                </select>
                                <!-- validation -->
                                <div v-if="validation.pengguna" class="mt-2 alert alert-danger">
                                    {{ validation.pengguna[0]
                                    }}
                                </div>
                            </div>   
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                            <router-link :to="{ name: 'peminjaman.index' }" type="submit" class="btn btn-danger">BACK</router-link>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive, onMounted, ref} from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'


export default {
    setup() {

 //reactive state
 let buku = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/buku')
                .then(response => {
                    //assign state posts with response data
                    buku.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

//reactive state
let pengguna = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/pengguna')
                .then(response => {
                    //assign state posts with response data
                    pengguna.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })

        //state peminjaman
        const peminjaman = reactive({
            peminjaman: '',
            waktu_mulai: '',
            buku:'',
            pengguna: '',
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        const route = useRoute()

//mounted
onMounted(() => {

//get API from Laravel Backend
axios.get(`http://localhost:8000/api/peminjaman/${route.params.id}`)
.then(response => {
            
    //assign state peminjaman with response data
    peminjaman.waktu_mulai= response.data.data.waktu_mulai,
    peminjaman.durasi_peminjaman = response.data.data.durasi_peminjaman,
    peminjaman.buku= response.data.data.buku,
    peminjaman.pengguna= response.data.data.pengguna

}).catch(error => {
    console.log(error.response.data)
})

})
        //method update
        function update() {
            let waktu_mulai = peminjaman.waktu_mulai
            let durasi_peminjaman = peminjaman.durasi_peminjaman
            let buku = peminjaman.buku
            let pengguna = peminjaman.pengguna
            axios.put(`http://localhost:8000/api/peminjaman/${route.params.id}`, {
                waktu_mulai: waktu_mulai,
                durasi_peminjaman: durasi_peminjaman,
                buku: buku,
                pengguna: pengguna,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'peminjaman.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            peminjaman,
            validation,
            router,
            update,
            buku,
            pengguna,
        }
    }
}
</script>
<style>

</style>