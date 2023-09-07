<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH MEMBER</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Member</label>
                                <input type="text" class="form-control" v-model="member.nama_member"
                                    placeholder="Masukkan Nama Member">
                                <!-- validation -->
                                <div v-if="validation.nama_member" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nama_member[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Password</label>
                                <input type="password" class="form-control" v-model="member.password_member"
                                    placeholder="Masukkan Password">
                                <!-- validation -->
                                <div v-if="validation.password_member" class="mt-2 alert alert-danger">
                                    {{
                                            validation.password_member[0]
                                    }}
                                </div>
                            </div>
                            <!-- <div class="form-group mb-3">
                                <label for="content" class="form-label">Konfirmasi Password</label>
                                <input class="form-control" v-model="member.password"
                                    placeholder="Konfirmasi Password">

                                <div v-if="validation.password" class="mt-2 alert alert-danger">
                                    {{
                                            validation.password[0]
                                    }}
                                </div>
                            </div> -->
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input class="form-control" v-model="member.email" placeholder="Masukkan Email">
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ 
                                    validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Telepon</label>
                                <input class="form-control" v-model="member.nomor_telepon"
                                    placeholder="Masukkan Nomor Telepon">
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
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    setup() {
        //state member
        const member = reactive({
            member: '',
            password_member: '',
            email: '',
            nomor_telepon: '',
            tanggal_lahir:'',
            expired_date:'',
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        //method store
        function store() {
            let nama_member = member.nama_member
            let password_member = member.password_member
            let email = member.email
            let nomor_telepon = member.nomor_telepon
            let tanggal_lahir = member.tanggal_lahir
            let today =  new Date();
            let nextYear = new Date();
            nextYear.setFullYear(today.getFullYear() + 1);
            let expired_date = new Date(nextYear.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().slice(0,10); // format as yyyy-mm-dd
            axios.post('http://localhost:8000/api/member', {
                nama_member: nama_member,
                password_member: password_member,
                email: email,
                nomor_telepon: nomor_telepon,
                tanggal_lahir: tanggal_lahir,
                expired_date : expired_date,
                depositKelas : 0
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
        return {
            member,
            validation,
            router,
            store
        }
    }
}
</script>
<style>

</style>