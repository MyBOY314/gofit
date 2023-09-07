<template>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">GOFIT</h5>
        <p>Jl. Centralpark No. 10 Yogyakarta</p>
        <h5 class="card-title">Member Card</h5>
        <div ref="pdfContent">
          <p v-for="(member, index) in members" :key="index">
            <strong>Nomor: {{ formatMonth(member.created_at) }}.{{ formatYear(member.created_at) }}.{{ member.id }}</strong> <br>
            <strong>Nama: {{ member.nama_member }}</strong> <br>
            <strong>Tanggal Lahir: {{ member.tanggal_lahir }}</strong> <br>
            <strong>Nomor Telpon: {{ member.nomor_telepon }}</strong> <br>
            <strong>Email: {{ member.email }}</strong> <br>
          </p>
        </div>
        <button @click="generatePDF" class="btn btn-sm btn-primary mr-1">Generate PDF</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  import { reactive, onMounted } from "vue";
  import { useRouter, useRoute } from "vue-router";
  import jsPDF from 'jspdf';
  import 'jspdf-autotable';
  
  export default {
    setup() {
      const members = reactive([]);
      const router = useRouter();
      const route = useRoute();
  
      const generatePDF = () => {
        if (members.length > 0) {
          const member = members[0];
          const doc = new jsPDF();
          doc.text('Member Card', 105, 20, { align: 'center' });
          const tableData = [
            ['Nomor', formatMonth(member.created_at) + formatYear(member.created_at) + member.id],
            ['Nama', member.nama_member],
            ['Tanggal Lahir', member.tanggal_lahir],
            ['Nomor Telepon', member.nomor_telepon],
            ['Email', member.email],
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
          doc.save('member-card.pdf');
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
        axios.get(`http://localhost:8000/api/member/${route.params.id}`)
          .then((response) => {
            members.push(response.data.data);
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      });
  
      return {
        members,
        router,
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