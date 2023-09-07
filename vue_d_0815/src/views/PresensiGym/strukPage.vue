<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">GOFIT</h5>
      <p>Jl. Centralpark No. 10 Yogyakarta</p>
      <h5 class="card-title">Presensi Gym Struk</h5>
      <div ref="pdfContent">
        <p v-for="(presensiGym, index) in presensiGym" :key="index">
          <strong>No Struk: {{ formatMonth(presensiGym.booking_gym.member.created_at) }}.{{ presensiGym.id }}</strong><br>
          <strong>Tanggal: {{ presensiGym.booking_gym.tanggal }}</strong><br>
          <strong>Member: {{ formatMonth(presensiGym.booking_gym.member.created_at) }}.{{ presensiGym.booking_gym.member.id }}/{{ presensiGym.booking_gym.member.nama }}</strong><br>
          <strong>Slot waktu: {{ presensiGym.booking_gym.gym.slot_waktu }}</strong>
        </p>
      </div>
      <button @click="generatePDF" class="btn btn-sm btn-primary mr-1">Generate PDF</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import jsPDF from 'jspdf';
import 'jspdf-autotable';

export default {
  setup() {
    const presensiGyms = ref([]);
    const route = useRoute();

    const generatePDF = () => {
      if (presensiGyms.value.length > 0) {
        const presensiGym = presensiGyms.value[0];
        const doc = new jsPDF();
        doc.text('presensiGym Card', 105, 20, { align: 'center' });
        const tableData = [
          ['Nomor :', formatMonth(presensiGym.created_at) + formatYear(presensiGym.created_at) + presensiGym.id],
          ['Tanggal :', presensiGym.booking_gym.tanggal],
          ['Member', formatMonth(presensiGym.booking_gym.member.created_at),' / ',presensiGym.id],
          ['Slot Waktu', presensiGym.booking_gym.slot_waktu],
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
        doc.save('presensiGym-card.pdf');
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

    // Fetch presensiGym data
    onMounted(() => {
      axios.get(`http://localhost:8000/api/presensiGym/${route.params.id}`)
        .then((response) => {
          presensiGyms.value.push(response.data.data);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    return {
      presensiGyms,
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