<template>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">GOFIT</h5>
        <p>Jl. Centralpark No. 10 Yogyakarta</p>
        <h5 class="card-title">Struk Deposit Kelas</h5>
        <div ref="pdfContent">
          <p v-for="(depositReguler, id) in depositReguler" :key="id">
            <strong>Nomor Struk: {{ formatMonth(depositReguler.created_at) }}.{{ formatYear(depositReguler.created_at) }}.{{ depositReguler.id }}
            </strong> <br>
            <strong>Jumlah Deposit: {{ depositReguler.deposit_uang }}</strong> <br>
            <strong>Nama Member: {{ depositReguler.member_id }}</strong> <br>
            <strong>Kasir: {{ depositReguler.pegawai_id }}</strong><br>
          </p>
        </div>
        <button @click="generatePDF" class="btn btn-sm btn-primary mr-1">Generate Struk</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  import { onMounted,reactive, ref } from 'vue'
  import { useRouter, useRoute } from "vue-router";
  import jsPDF from 'jspdf';
  import 'jspdf-autotable';
  
  export default {
    setup() {
      const depositRegulers = reactive([]);
      const pegawai = reactive([]);
      const member = reactive([]);
      // const pegawais = reactive({ data: [] })
      // const members = reactive({ data: [] })
      const router = useRouter();
      const route = useRoute();
  
      const generatePDF = () => {
        if (depositRegulers.length > 0) {
          const depositReguler = depositRegulers[0];
          const doc = new jsPDF();
          doc.text('depositReguler Card', 105, 20, { align: 'center' });
          const tableData = [
            ['Nomor', formatMonth(depositReguler.created_at) + formatYear(depositReguler.created_at) + depositReguler.id],
            ['Jumlah Deposit', depositReguler.deposit_uang],
            ['Member', depositReguler.member_id],
            ['Kasir', depositReguler.pegawai_id],
          ];
          doc.autoTable({
            startY: 30,
            head: [['', '']],
            body: tableData,
            theme: 'striped',
            styles: {
              cellPadding: 6,
              fontSize: 12,
              valign: 'middle',
              overflow: 'linebreak',
              halign: 'center',
            },
            columnStyles: {
              0: {
                fontStyle: 'bold',
                halign: 'right',
                width: '40%',
              },
              1: {
                width: '60%',
              },
            },
          });
          doc.save('depositReguler-card.pdf');
        }
      };
  
      const formatMonth = (timestamp) => {
        const date = new Date(timestamp);
        const month = ("0" + (date.getMonth() + 1)).slice(-2);
        return `${month}`;
      };

      const formatYear = (timestamp) => {
      const date = new Date(timestamp);
      const year = date.getFullYear().toString().slice(-2);
      return `${year}`;
    };
  
      onMounted(() => {
        let member = ref([])

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/member')
                .then(response => {
                    //assign state posts with response data
                    member.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })

        //reactive state
let pegawai = ref([])

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/pegawais')
                .then(response => {
                    //assign state posts with response data
                    pegawai.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })

        axios.get(`http://localhost:8000/api/depositReguler/${route.params.id}`)
          .then((response) => {
            depositRegulers.push(response.data.data);
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      });
  
      return {
        depositRegulers,
        router,
        pegawai,
        member,
        
        generatePDF,
        formatMonth,
        formatYear,
      };
  
    },
  };
  </script>
  
  <style scoped>
  .card {
    width: 600px;
    margin: auto;
  }
  </style>