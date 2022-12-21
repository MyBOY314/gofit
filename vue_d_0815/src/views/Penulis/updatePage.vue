<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT PENULIS</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Penulis</label>
                                <input type="text" class="form-control" v-model="penulis.nama"
                                    placeholder={{penulis.nama}}>
                                <!-- validation -->
                                <div v-if="validation.nama" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nama[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Tanggal Lahir</label>
                                <input class="form-control" v-model="penulis.tanggal_lahir" placeholder={{penulis.tanggal_lahir}}>
                                <!-- validation -->
                                <div v-if="validation.tanggal_lahir" class="mt-2 alert alert-danger">
                                    {{ validation.tanggal_lahir[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Deskripsi</label>
                                <input class="form-control" v-model="penulis.deskripsi"
                                    placeholder={{penulis.deskripsi}}>
                                <!-- validation -->
                                <div v-if="validation.deskripsi" class="mt-2 alert alert-danger">
                                    {{
                                            validation.deskripsi[0]
                                    }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                            <router-link :to="{ name: 'penulis.index' }" type="submit" class="btn btn-danger">BACK</router-link>
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
        //state proyek
        const penulis = reactive({
            penulis: '',
            nama: '',
            tanggal_lahir: '',
            deskripsi: ''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        const route = useRoute()

//mounted
onMounted(() => {

//get API from Laravel Backend
axios.get(`http://localhost:8000/api/penulis/${route.params.id}`)
.then(response => {
            
    //assign state proyek with response data
    penulis.nama= response.data.data.nama,
    penulis.tanggal_lahir= response.data.data.tanggal_lahir,
    penulis.deskripsi= response.data.data.tanggal_lahir

}).catch(error => {
    console.log(error.response.data)
})

})
        //method update
        function update() {
            let nama = penulis.nama
            let tanggal_lahir = penulis.tanggal_lahir
            let deskripsi = penulis.deskripsi
            axios.put(`http://localhost:8000/api/penulis/${route.params.id}`, {
                nama : nama,
                tanggal_lahir : tanggal_lahir,
                deskripsi : deskripsi
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'penulis.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            penulis,
            validation,
            router,
            update
        }
    }
}
</script>
<style>

</style>