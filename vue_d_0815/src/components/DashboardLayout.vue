<template>
    
    <!-- <nav class="navbar navbar-dark bg-dark fixed-top">
      </nav> -->
    <header class="navbar navbar-dark sticky-top bg-dark flex-mdnowrap p-0 shadow">
        <div class="container">
              <a class="navbar-brand fw-bold" href="../index.php">GO-FIT 10815</a>
              <div class="d-flex justify-content-end">
                    <router-link :to="{ name: 'register' }" class="btn btn-primary me-2">Sign Up</router-link>
                    <router-link :to="{ name: 'login' }" class="btn btn-warning ms-2">Logout</router-link>
              </div>
          </div>
          <img src="https://media.tenor.com/9n_h3ogS6ucAAAAi/pepe-leave.gif" class="img-fluid" 
        style="  height:3%; width: 3%;" />
        <!-- <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#" style="color:aquamarine">Healthy Body, Healthy Mind</a> -->
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" ariacontrols="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <router-link :to="{ name: 'opening' }" class="btn btn-outline-light btn-lg m-2">EXIT</router-link>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-mdblock bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <!-- <li class="nav-item">
                            <router-link :to="{ name: 'pengguna.index' }" class="nav-link">Pengguna</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'peminjaman.index' }" class="nav-link">Peminjaman</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'penulis.index' }" class="nav-link">Penulis</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'buku.index' }" class="nav-link">Buku</router-link>
                        </li> -->
                        <li class="nav-item">
                            <router-link :to="{ name: 'instruktur.index' }" class="nav-link">Instruktur</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'member.index' }" class="nav-link">Member</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'depositReguler.index' }" class="nav-link">Deposit Reguler</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'depositKelas.index' }" class="nav-link">Deposit Kelas</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'jadwalUmum.index' }" class="nav-link">Jadwal Umum</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'jadwalHarian.index' }" class="nav-link">Jadwal Harian</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'izinInstruktur.index' }" class="nav-link">Izin Instruktur</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'presensiGym.index' }" class="nav-link">Presensi Gym</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'laporan.pendapatan' }" class="nav-link">Laporan Pendapatan</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'laporan.gym' }" class="nav-link">Laporan Gym</router-link>
                        </li>
                        <!-- <li class="nav-item">
                            <router-link :to="{ name: 'pegawai.index' }" class="nav-link">Pegawai</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'proyek.index' }" class="nav-link">Proyek</router-link>
                        </li> -->
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md4">
                <!-- View Route -->
                <router-view></router-view>
            </main>
        </div>
    </div>
    
</template>

<script>
export default {
}
</script>
<style>
body {
    font-size: .875rem;
}

.feather {
    width: 16px;
    height: 16px;
    vertical-align: text-bottom;
}

/*
* Sidebar
*/
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    padding: 48px 0 0;
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.481);
    background-image: url('https://media.tenor.com/vYg4q_y6vuUAAAAM/pink-cloud.gif');
    background-size: contain;
}

.sidebar-sticky {
    position: relative;
    top: 0;
    height: calc(100vh - 48px);
    padding-top: .5rem;
    overflow-x: hidden;
    overflow-y: auto;
}

.sidebar .nav-link {
    font-weight: 500;
    color: #1f1f18;
    font-size: 200%;
    background-color: rgba(11, 92, 0, 0.074);
}

.sidebar .nav-link .feather {
    margin-right: 4px;
    color: #727272;
}

.sidebar .nav-link.active {
    color: #2470dc;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
    color: inherit;
}

.sidebar-heading {
    font-size: .95rem;
    text-transform: uppercase;
    
}

/*
* Navbar
*/
.navbar-brand {
    padding-top: .75rem;
    padding-bottom: .75rem;
    font-size: 1rem;
    background-color: rgba(57, 51, 51, 0.663);
    /* box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.053); */
}

.navbar .navbar-toggler {
    top: .25rem;
    right: 1rem;
}

.navbar .form-control {
    padding: .75rem 1rem;
    border-width: 0;
    border-radius: 0;
}

.form-control-dark {
    color: #fff;
    background-color: rgba(255, 255, 255, .1);
    border-color: rgba(255, 255, 255, .1);
    
}

.form-control-dark:focus {
    border-color: transparent;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}

/* .background {
    background-color: lightblue;
   
    background-size: contain; */
    /* background-size: cover; */
    /* other background styles */
  /* } */
  /* .container{
    background-image: url('https://media.tenor.com/qg8YV3fVfA4AAAAC/clouds.gif');
    background-size: contain;
    
  } */

  body{
    background-image: url('https://media.tenor.com/wIa91mot0tAAAAAd/pixel-city-chill.gif');
    background-size: cover;
}
</style>