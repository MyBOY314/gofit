<template>
    <!--Main Navigation-->
  <header>
    <!-- <style>
      #intro {
        background-image: url("https://mdbootstrap.com/img/new/fluid/city/018.jpg");
        height: 100vh;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style> -->

    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask" style="background-color: cadetblue;">
        <!-- <img src="https://cdn.thelondoneconomic.com/wp-content/uploa…f6-screen-shot-2021-08-04-at-15.40.32-768x432.jpg" class="img-fluid"/> -->
        
        <div class="container d-flex align-items-center justify-content-center text-center h-100">
        
          <div class="text-white">
            <h1 class="mb-3">GO-FIT</h1>
            <h5 class="mb-4">"This is POWER"</h5>
            <router-link :to="{ name: 'login' }" class="btn btn-outline-light btn-lg m-2">Login</router-link>

            <a class="btn btn-outline-light btn-lg m-2" href="https://mdbootstrap.com/docs/standard/" target="_blank"
              role="button">Exit</a>
          </div>
        </div>
        <img src="https://media.tenor.com/qhcRVSoKQ-YAAAAi/totoro-discord.gif" class="img-fluid" 
        style="display: block;
  margin-left: auto;
  margin-right: auto;
  height:20%;
  width: 30%;" />
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">
      <!--Section: Content-->
      <section>
        <div class="row">
          <div class="col-md-6 gx-5 mb-4">
            <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
              <img src="	https://media.tenor.com/PIMT_76mlyEAAAAd/subaru-exercising.gif" class="img-fluid" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a>
            </div>
          </div>

          <div class="col-md-6 gx-5 mb-4">
            <h4><strong>Rekomendasi Kelas</strong></h4>
            <p class="text-muted">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod itaque voluptate
              nesciunt laborum incidunt. Officia, quam consectetur. Earum eligendi aliquam illum
              alias, unde optio accusantium soluta, iusto molestiae adipisci et?
            </p>
            <p><strong>Jam Buka</strong></p>
            <p class="text-muted">
              Akan ada tujuh slot waktu ya, yaitu jam 7-9, 9-11, 11-13, 13-15, 15-17, 17-19, dan 19-21.
            </p>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <!--Section: Content-->
      <section class="text-center">
        <h4 class="mb-5"><strong>Kumpulan User</strong></h4>

        <div class="row">
          <div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="https://64.media.tumblr.com/5dcfbd3d5e6be84749ce531e476611fd/b3939d90abdb7785-eb/s1280x1920/db60b050e62e77c905a80fec8b72a50583cb5e34.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Cashier</h5>
                <p class="card-text">
                    Login Kasir
                </p>
                <router-link :to="{ name: 'member.index' }" class="btn btn-primary">Member</router-link>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="https://imagecache.civitai.com/xG1nkqKTMzGDvpLrqFT7WA/b0fcd678-6826-4fae-f073-01968f00fd00/width=1024/381594.jpeg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Admin</h5>
                <p class="card-text">
                  Login Admin
                </p>
                <router-link :to="{ name: 'instruktur.index' }" class="btn btn-primary">Instruktur</router-link>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="https://steamuserimages-a.akamaihd.net/ugc/1692778329729634717/421568F160E8F219F72FCBF51BA224F55AD399E2/?imw=512&&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=false" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Manager Operasional</h5>
                <p class="card-text">
                  Login Manager Operasional
                </p>
                <router-link :to="{ name: 'jadwalUmum.index' }" class="btn btn-primary">Jadwal</router-link>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <!--Section: Content-->
      <section class="mb-5">

        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
           
          </div>
        </div>
      </section>
      <!--Section: Content-->
    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    <!-- <div class="py-4 text-center">
      <a role="button" class="btn btn-primary btn-lg m-2"
        href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" rel="nofollow" target="_blank">
        Learn Bootstrap 5
      </a>
      <a role="button" class="btn btn-primary btn-lg m-2" href="https://mdbootstrap.com/docs/standard/" target="_blank">
        Download MDB UI KIT
      </a>
    </div> -->

    <hr class="m-0" />



    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
  </template>