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
                                <label class="form-label">Nama Instruktur</label>
                                <input type="text" class="form-control" v-model="instruktur.nama_instruktur"
                                    placeholder={{instruktur.nama_instruktur}}>
                                <!-- validation -->
                                <div v-if="validation.nama_instruktur" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nama_instruktur[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input type="text" class="form-control" v-model="instruktur.email" placeholder={{instruktur.email}}>
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Telepon</label>
                                <input class="form-control" v-model="instruktur.nomor_telepon"
                                    placeholder={{instruktur.nomor_telepon}}>
                                <!-- validation -->
                                <div v-if="validation.nomor_telepon" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nomor_telepon[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Terlambat</label>
                                <input class="form-control" v-model="instruktur.terlambat"
                                    placeholder={{instruktur.terlambat}}>
                                <!-- validation -->
                                <div v-if="validation.terlambat" class="mt-2 alert alert-danger">
                                    {{
                                            validation.terlambat[0]
                                    }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                            <router-link :to="{ name: 'instruktur.index' }" type="submit" class="btn btn-danger">BACK</router-link>
                            
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
        //state instruktur
        const instruktur = reactive({
            instruktur: '',
            email: '',
            nomor_telepon: '',
            terlambat: '',
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        const route = useRoute()

//mounted
onMounted(() => {

//get API from Laravel Backend
axios.get(`http://localhost:8000/api/instruktur/${route.params.id}`)
.then(response => {
            
    //assign state instruktur with response data
    instruktur.nama_instruktur= response.data.data.nama_instruktur,
    instruktur.email= response.data.data.email,
    instruktur.nomor_telepon= response.data.data.nomor_telepon,
    instruktur.terlambat= response.data.data.terlambat

}).catch(error => {
    console.log(error.response.data)
})

})
        //method update
        function update() {
            let nama_instruktur = instruktur.nama_instruktur
            let email = instruktur.email
            let nomor_telepon = instruktur.nomor_telepon
            let terlambat = instruktur.terlambat
            axios.put(`http://localhost:8000/api/instruktur/${route.params.id}`, {
                nama_instruktur: nama_instruktur,
                email: email,
                nomor_telepon: nomor_telepon,
                terlambat: terlambat,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'instruktur.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            instruktur,
            validation,
            router,
            update
        }
    }
}
</script>
<style>

</style>