<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH DEPOSIT REGULER</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Jumlah Deposit Uang</label>
                                <input type="number" class="form-control" v-model="depositReguler.deposit_uang"
                                    placeholder="Masukkan Jumlah Deposit" min="500000">
                                <!-- validation -->
                                <div v-if="validation.deposit_uang" class="mt-2 alert alert-danger">
                                    {{
                                            validation.deposit_uang[0]
                                    }}
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Member</label>
                                <select class="select form-control" v-model="depositReguler.member" placeholder="Pilih Member">
                                    <option disabled selected style="display: ruby;">Pilih Member</option>
                                    <option v-for="member in member" :key="member.id" :value="member.id">
                                    {{ member.nama_member }}
                                    </option>
                                </select>
                                <div v-if="validation.member" class="mt-2 alert alert-danger">{{validation.member[0]}}</div>
                            </div>

                                     <div class="form-group mb-3">
                                        <label for="content" class="form-label">Pegawai</label>
                                        <select class="select form-control" v-model="depositReguler.pegawai" placeholder="Pilih Pegawai">
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
        //state depositReguler
        const depositReguler = reactive({
            depositReguler: '',
            deposit_uang: '',
            member: '',
            pegawai: '',
        
        })

        let member = ref([])
        let pegawai = ref([])
        //mounted
        onMounted(() => {
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
            let deposit_uang= depositReguler.deposit_uang
            let pegawai = depositReguler.pegawai
            let member = depositReguler.member

            if (deposit_uang === 3000000) {
                deposit_uang += 300000;
                } 

            let today =  new Date();
            let nextYear = new Date();
            nextYear.setFullYear(today.getFullYear() + 1);

            // let expired_date = new Date(nextYear.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().slice(0,10);
             // format as yyyy-mm-dd
            axios.post('http://localhost:8000/api/depositReguler', {
                deposit_uang: deposit_uang,
                member_id: member,
                kasir_id: pegawai,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'depositReguler.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        return {
            depositReguler,
            validation,
            router,
            store,

            pegawai,
            member,
        }
    }
}
</script>
<style>

</style>