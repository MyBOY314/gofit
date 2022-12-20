<template>
    <section class="vh-100" style="background-image:url(https://media.tenor.com/9vRAkntogEMAAAAd/background.gif)">
      <nav class="navbar navbar-dark bg-dark fixed-top">
          <div class="container">
              <!-- Nama : nama panggilan kalian -->
              <a class="navbar-brand fw-bold" href="../index.php">COMIC READER 10815</a>
              <div class="d-flex justify-content-end">
                  <button class="btn btn-primary me-2" type="button">
                      <a class="text-light" style="text-decoration: none" href="./page/registerPage.php">Sign Up</a>
                  </button>
                  <button class="btn btn-warning ms-2" type="button" href="./loginPage.php">
                      <a class="text-light" style="text-decoration: none" href="./page/loginPage.php">Login</a>
                  </button>
              </div>
          </div>
      </nav>
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://media.tenor.com/qDK7klsHthQAAAAd/ina-anime.gif"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
  
                  <form>
  
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      
                      <!-- <img src="https://media.tenor.com/no2CaWaci50AAAAi/needy-streamer-overload-reading.gif" style="border-radius:50%;"> -->
                      <img src="https://media.tenor.com/mVh2xCreYaYAAAAC/clang.gif" style="border-radius:50%; height:60px; width:60px;"> 
                      <span class="h1 fw-bold mb-0">Login</span>
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
  
                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example17" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Email address</label>
                    </div>
  
                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example27" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>
  
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="button">Login</button>
                    </div>
  
                    <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                        style="color: #393f81;">Register here</a></p>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </template>
  
  <script>
  export default {
    data() {
      return {
        image: { backgroundImage: "https://media.tenor.com/9vRAkntogEMAAAAd/background.gif" }
      };
    }
  };
  </script>