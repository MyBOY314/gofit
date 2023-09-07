<template>
  <div class="dashboard">
    <div class="header">
      <h1 class="title">Dashboard</h1>
      <h2 class="subtitle">Welcome, Kasir!!</h2>
    </div>

    <div class="container mt-5">
      <div class="card border-0 rounded shadow">
        <div class="card-body">
          <div class="header-section">
            <h1 class="title">GoFit</h1>
            <h2 class="subtitle">LAPORAN GYM</h2>
          </div>
          <div class="info-section">
            <div class="location">
              <strong>Jl. Centralpark No. 10 Yogyakarta</strong>
              <br>
              <span>PERIODE: {{ selectedYear }}</span>
            </div>
            <div class="print-date">
              <span>Tanggal cetak: {{ getCurrentDate() }}</span>
            </div>
          </div>

         <div>
          <div class="year-input">
      <label for="day" class="input-label">Day:</label>
      <input type="number" id="day" class="form-control" v-model="selectedDay" @input="getMonthlySumData" placeholder="Enter day">
    </div>

    <div class="year-input">
      <label for="month" class="input-label">Month:</label>
      <input type="number" id="month" class="form-control" v-model="selectedMonth" @input="getMonthlySumData" placeholder="Enter month">
    </div>

    <div class="year-input">
      <label for="year" class="input-label">Year:</label>
      <input type="number" id="year" class="form-control" v-model="selectedYear" @input="getMonthlySumData" placeholder="Enter year">
    </div>

    <table class="table table-striped table-bordered mt-4">
      <thead class="thead-dark">
        <tr>
          <th scope="col">
            <center>Date</center>
          </th>
          <th scope="col">
            <center>Count</center>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(monthlySum, index) in monthlySumData" :key="index">
          <td><center>{{ monthlySum.date }}</center></td>
          <td><center>{{ monthlySum.count }}</center></td>
        </tr>
    </tbody>
  </table></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      monthlySumData: [],
      selectedDay: '',
      selectedMonth: '',
      selectedYear: new Date().getFullYear(),
    };
  },
  mounted() {
    this.getMonthlySumData();
  },
  methods: {
    getMonthlySumData() {
      axios
        .get(`http://127.0.0.1:8000/api/gym-rep/${this.selectedYear}/${this.selectedMonth}/${this.selectedDay}`)
        .then(response => {
          this.monthlySumData = response.data.counts;
        })
        .catch(error => {
          console.error(error);
        });
    },

    getMonthName(month) {
      const monthNames = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
      ];
      return monthNames[(month - 1) % 12];
    },
    getCurrentDate() {
      const options = {
        timeZone: 'Asia/Jakarta',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      };
      return new Date().toLocaleDateString('en-US', options);
    },
  },
};
</script>

<style scoped>
.dashboard {
  padding-top: 20px;
  padding-bottom: 20px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
}

.title {
  font-size: 24px;
}

.subtitle {
  color: #777;
}

.header-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.info-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.location {
  font-weight: bold;
}

.year-input {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 15px;
}

.input-label {
  margin-right: 10px;
}

.print-date {
  font-size: 14px;
  color: #777;
}

.table {
  margin-top: 20px;
}

.table th,
.table td {
  text-align: center;
}

.table thead th {
  background-color: #343a40;
  color: #fff;
}

.table tbody td {
  vertical-align: middle;
}
</style>