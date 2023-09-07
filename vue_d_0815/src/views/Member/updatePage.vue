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
                                <label class="form-label">Nama Member</label>
                                <input type="text" class="form-control" v-model="member.nama_member"
                                    placeholder={{member.nama_member}}>
                                <!-- validation -->
                                <div v-if="validation.nama_member" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nama_member[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input type="text" class="form-control" v-model="member.email" placeholder={{member.email}}>
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Telepon</label>
                                <input class="form-control" v-model="member.nomor_telepon"
                                    placeholder={{member.nomor_telepon}}>
                                <!-- validation -->
                                <div v-if="validation.nomor_telepon" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nomor_telepon[0]
                                    }}
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Tanggal Lahir</label>
                                <input class="form-control" type="date" v-model="member.tanggal_lahir"
                                    placeholder="Masukkan Tanggal Lahir">
                                <!-- validation -->
                                <div v-if="validation.tanggal_lahir" class="mt-2 alert alert-danger">
                                    {{
                                            validation.tanggal_lahir[0]
                                    }}
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Expired Date Aktivasi</label>
                                <input class="form-control" type="date" v-model="member.expired_date"
                                    placeholder="Masukkan Tanggal Lahir">
                                <!-- validation -->
                                <div v-if="validation.expired_date" class="mt-2 alert alert-danger">
                                    {{
                                            validation.expired_date[0]
                                    }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                            <router-link :to="{ name: 'member.index' }" type="submit" class="btn btn-danger">BACK</router-link>
                            
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
        //state member
        const member = reactive({
            member: '',
            pasword: '',
            email: '',
            nomor_telepon: '',
            tanggal_lahir:'',
            expired_date: '',
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        const route = useRoute()

//mounted
onMounted(() => {

//get API from Laravel Backend
axios.get(`http://localhost:8000/api/member/${route.params.id}`)
.then(response => {
            
    //assign state member with response data
    member.nama_member= response.data.data.nama_member,
    member.password= response.data.data.password,
    member.email= response.data.data.email,
    member.nomor_telepon= response.data.data.nomor_telepon
    member.tanggal_lahir= response.data.data.tanggal_lahir
    member.expired_date= response.data.data.expired_date

}).catch(error => {
    console.log(error.response.data)
})

})
        //method update
        function update() {
            let nama_member = member.nama_member
            // let password = member.tanggal_lahir
            let email = member.email
            let nomor_telepon = member.nomor_telepon
            let tanggal_lahir = member.tanggal_lahir
            let expired_date = member.expired_date
            axios.put(`http://localhost:8000/api/member/${route.params.id}`, {
                nama_member: nama_member,
                // password : password,
                email: email,
                nomor_telepon: nomor_telepon,
                tanggal_lahir: tanggal_lahir,
                expired_date: expired_date,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'member.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            member,
            validation,
            router,
            update
        }
    }
}
</script>
<style>

</style>