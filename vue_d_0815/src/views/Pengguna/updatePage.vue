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
                                <label class="form-label">Nama Pengguna</label>
                                <input type="text" class="form-control" v-model="pengguna.nama"
                                    placeholder={{pengguna.nama}}>
                                <!-- validation -->
                                <div v-if="validation.nama" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nama[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input type="text" class="form-control" v-model="pengguna.email" placeholder={{pengguna.email}}>
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Telepon</label>
                                <input class="form-control" v-model="pengguna.telepon"
                                    placeholder={{pengguna.telepon}}>
                                <!-- validation -->
                                <div v-if="validation.telepon" class="mt-2 alert alert-danger">
                                    {{
                                            validation.telepon[0]
                                    }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
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
        //state pengguna
        const pengguna = reactive({
            pengguna: '',
            email: '',
            telepon: ''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        const route = useRoute()

//mounted
onMounted(() => {

//get API from Laravel Backend
axios.get(`http://localhost:8000/api/pengguna/${route.params.id}`)
.then(response => {
            
    //assign state pengguna with response data
    pengguna.nama= response.data.data.nama,
    pengguna.email= response.data.data.email,
    pengguna.telepon= response.data.data.telepon

}).catch(error => {
    console.log(error.response.data)
})

})
        //method update
        function update() {
            let nama = pengguna.nama
            let email = pengguna.email
            let telepon = pengguna.telepon
            axios.put(`http://localhost:8000/api/pengguna/${route.params.id}`, {
                nama: nama,
                email: email,
                telepon: telepon
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'pengguna.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            pengguna,
            validation,
            router,
            update
        }
    }
}
</script>
<style>

</style>