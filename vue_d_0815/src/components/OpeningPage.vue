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
        <img src="https://media.tenor.com/1rvpTvBQfrQAAAAC/bookshelf-books.gif" class="img-fluid" 
        style="display: block;
  margin-left: auto;
  margin-right: auto;
  height:50%;
  width: 20%;" />
        <div class="container d-flex align-items-center justify-content-center text-center h-100">
          <div class="text-white">
            <h1 class="mb-3">Comic Reader Kelompok 6</h1>
            <h5 class="mb-4">Pemograman Web Ujian Akhir Semester</h5>
            <router-link :to="{ name: 'login' }" class="btn btn-outline-light btn-lg m-2">Login</router-link>

            <a class="btn btn-outline-light btn-lg m-2" href="https://mdbootstrap.com/docs/standard/" target="_blank"
              role="button">Exit</a>
          </div>
        </div>
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
              <img src="https://media.tenor.com/I05p_91Dph8AAAAd/cyberpunk-edgerunners-cyberpunk.gif" class="img-fluid" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a>
            </div>
          </div>

          <div class="col-md-6 gx-5 mb-4">
            <h4><strong>Rekomendasi Series</strong></h4>
            <p class="text-muted">
                Cyberpunk: Edgerunners menceritakan seorang anak bernama David Martinez yang berusaha bertahan hidup di tengah-tengah kota masa depan.
                 Kota tersebut terkenal dengan tindak korupsi serta obsesi atas teknologi dan modifikasi terhadap tubuh.
                  Demi keberlangsungan hidupnya, David memutuskan untuk menjadi seorang edgerunner, yakni penjahat bayaran yang juga dikenal dengan sebutan 'Cyberpunk'.
            </p>
            <p><strong>Doloremque vero ex debitis veritatis?</strong></p>
            <p class="text-muted">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod itaque voluptate
              nesciunt laborum incidunt. Officia, quam consectetur. Earum eligendi aliquam illum
              alias, unde optio accusantium soluta, iusto molestiae adipisci et?
            </p>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <!--Section: Content-->
      <section class="text-center">
        <h4 class="mb-5"><strong>Kumpulan Buku Kami</strong></h4>

        <div class="row">
          <div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="https://m.media-amazon.com/images/I/51OwMSETOJL.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Lord Of The Rings</h5>
                <p class="card-text">
                    Frodo, si hobbit muda, mewarisi sebuah cincin berkekuatan jahat milik Sauron, sang Penguasa Kegelapan. 
                    Kini, ia harus memulai perjalanan panjang penuh bahaya menuju Mount Doom demi menghancurkannya.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="	https://upload.wikimedia.org/wikipedia/id/9/99/Solo_Leveling_Webtoon.png" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Solo Leveling</h5>
                <p class="card-text">
 Suatu ketika saat rombongan Sung Jin-Woo menyelesaikan sebuah Gate.
  Namun di luar dugaan, Gate yang awalnya adalah rank D berubah menjadi sangat mematikan.
   Singkat cerita Sung Jin-Woo menjadi tumbal dengan dirinya ditinggalkan di dalam Gate tersebut untuk menyelamatkan rekannya. 
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="https://upload.wikimedia.org/wikipedia/it/c/cb/Chainsaw_Man_Volume_1.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Chainsaw Man</h5>
                <p class="card-text">
                    Chainsaw Man menceritakan tentang seorang pemuda yang bernama Denji. Denji hidup bersama dengan Pochita, sang iblis dengan gergaji mesin.
                     Kehidupan Denji sangat miris karena selain miskin dia juga harus melunasi hutang peninggalan orang tuanya.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <!--Section: Content-->
      <section class="mb-5">
        <h4 class="mb-5 text-center"><strong>Facilis consequatur eligendi</strong></h4>

        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <form>
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="form3Example1" class="form-control" />
                    <label class="form-label" for="form3Example1">First name</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="form3Example2" class="form-control" />
                    <label class="form-label" for="form3Example2">Last name</label>
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="form3Example3" class="form-control" />
                <label class="form-label" for="form3Example3">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control" />
                <label class="form-label" for="form3Example4">Password</label>
              </div>

              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" checked />
                <label class="form-check-label" for="form2Example3">
                  Subscribe to our newsletter
                </label>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
                Sign up
              </button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>or sign up with:</p>
                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab-fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-github"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!--Section: Content-->
    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    <div class="py-4 text-center">
      <a role="button" class="btn btn-primary btn-lg m-2"
        href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" rel="nofollow" target="_blank">
        Learn Bootstrap 5
      </a>
      <a role="button" class="btn btn-primary btn-lg m-2" href="https://mdbootstrap.com/docs/standard/" target="_blank">
        Download MDB UI KIT
      </a>
    </div>

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