<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH DEPOSIT KELAS</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Jumlah Deposit</label>
                                <input type="number" class="form-control" v-model="depositKelas.jumlah_deposit"
                                    placeholder="Masukkan Jumlah Deposit" step="5" min="5" max="10" >
                                <!-- validation -->
                                <div v-if="validation.deposit_kelas" class="mt-2 alert alert-danger">
                                    {{ validation.deposit_kelas[0] }}
                                </div>
                                </div>

                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Kelas</label>
                                <select class="select form-control" v-model="depositKelas.kelas" placeholder="Pilih Kelas">
                                    <option disabled selected style="display: ruby;">Pilih Kelas</option>
                                    <option v-for="kelas in kelas" :key="kelas.id" :value="kelas.id">
                                    {{ kelas.nama }}
                                    </option>
                                </select>
                                <div v-if="validation.kelas" class="mt-2 alert alert-danger">{{validation.kelas[0]}}</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Member</label>
                                <select class="select form-control" v-model="depositKelas.member" placeholder="Pilih Member">
                                    <option disabled selected style="display: ruby;">Pilih Member</option>
                                    <option v-for="member in member" :key="member.id" :value="member.id">
                                    {{ member.nama_member }}
                                    </option>
                                </select>
                                <div v-if="validation.member" class="mt-2 alert alert-danger">{{validation.member[0]}}</div>
                            </div>

                                     <div class="form-group mb-3">
                                        <label for="content" class="form-label">Pegawai</label>
                                        <select class="select form-control" v-model="depositKelas.pegawai" placeholder="Pilih Pegawai">
                                            <option disabled selected style="display: ruby;">Pilih Pegawai</option>
                                            <option v-for="pegawai in pegawai" :key="pegawai.id" :value="pegawai.id">
                                                {{ pegawai.nama }}
                                            </option>
                                        </select>
                                        <div v-if="validation.pegawai" class="mt-2 alert alert-danger">{{validation.pegawai[0]}}</div>
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
import { onMounted,reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    
    setup() {
        //state depositKelas
        const depositKelas = reactive({
            depositKelas: '',
            expired_date: '',
            member: '',
            pegawai: '',
            kelas: '',
        
        })
        let kelas = ref([])
        let member = ref([])
        let pegawai = ref([])
        //mounted
        onMounted(() => {
            axios.get('http://localhost:8000/api/kelas')
                .then(response => {
                    //assign state posts with response data
                    kelas.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/member')
                .then(response => {
                    //assign state posts with response data
                    member.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/pegawais')
                .then(response => {
                    //assign state posts with response data
                    pegawai.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
                
        })

        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()
        //method store
        function store() {
            let jumlah_deposit= depositKelas.jumlah_deposit
            let kelas = depositKelas.kelas
            let pegawai = depositKelas.pegawai
            let member = depositKelas.member

            let today = new Date();
            let nextYear = new Date();
            
            if (jumlah_deposit === 10) {
                nextYear.setMonth(today.getMonth() + 2);
            }else{
                nextYear.setMonth(today.getMonth() + 1);
            }
            let expired_date = new Date(nextYear.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().slice(0,10);

            if (jumlah_deposit === 10) {
                jumlah_deposit += 2;
                } else if (jumlah_deposit === 5) {
                jumlah_deposit += 1;
                }
            axios.post('http://localhost:8000/api/depositKelas', {
                jumlah_deposit: jumlah_deposit,
                expired_date: expired_date,
                kelas_id: kelas,
                member_id: member,
                kasir_id: pegawai,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'depositKelas.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        return {
            depositKelas,
            validation,
            router,
            store,

            pegawai,
            member,
            kelas,
        }
    }
}
</script>
<style>

</style>