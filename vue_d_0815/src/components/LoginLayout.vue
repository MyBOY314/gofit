<template>
  <section
    class="vh-100"
    style="
      background-image: url(https://media.tenor.com/9vRAkntogEMAAAAd/background.gif);
    "
  >
  <nav class="navbar navbar-light custom-navbar fixed-top">
      <div class="container">
        <router-link :to="{ name: 'opening' }" class="btn btn-secondary me-2"
          >Return</router-link
        >
        <img
          src="https://www.pertamina.com/landing/images/logo.png"
          class="img-fluid"
          alt="Pertamina Logo"
          style="height: 10%; width: 10%"
        />
        <!-- <a class="navbar-brand fw-bold" href="../index.php">GO-FIT 10815</a> -->

        <div class="d-flex justify-content-end">
          <h6 class="bigger-text">Inventory</h6>
          <!-- <router-link :to="{ name: 'login' }" class="btn btn-warning ms-2">Login</router-link> -->
        </div>
      </div>
    </nav>
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem">
            <div class="row g-0">
              <div class="col-md-10 col-lg-5 d-none d-md-block text-center">
                <div
                  class="d-flex justify-content-center align-items-center h-100"
                >
                  <img
                    src="https://www.pertamina.com/landing/images/org%20135.jpg"
                    alt="login form"
                    class="img-fluid"
                    style="
                      width: 100%;
                      height: 100%;
                      object-fit: cover;
                      border-radius: 1rem 0 0 1rem;
                    "
                  />
                </div>
              </div>

              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-5 p-lg-5 text-black">
                  <form>
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i
                        class="fas fa-cubes fa-2x me-3"
                        style="color: #ff6219"
                      ></i>

                      <!-- <img src="https://media.tenor.com/no2CaWaci50AAAAi/needy-streamer-overload-reading.gif" style="border-radius:50%;"> -->
                      <span class="h1 fw-bold mb-0">Login</span>
                      <img
                        src="https://media.tenor.com/gHygBs_JkKwAAAAi/moving-boxes.gif"
                        style="border-radius: 50%; height: 90px; width: 90px"
                      />
                    </div>

                    <h5
                      class="fw-normal mb-3 pb-3 moving-text"
                      style="letter-spacing: 1px"
                    >
                      Sign into your account!
                    </h5>
                    <form @submit.prevent="login">
                      <div class="form-outline mb-4">
                        <input
                          type="text"
                          v-model="nama"
                          id="form2Example17"
                          class="form-control form-control-lg"
                          placeholder="Masukkan Username"
                        />
                        <label class="form-label hint" for="form2Example17"
                          >Username</label
                        >
                      </div>

                      <div class="form-outline mb-4">
                        <input
                          type="password"
                          v-model="password"
                          id="form2Example27"
                          class="form-control form-control-lg"
                          placeholder="Masukkan Password"
                        />
                        <label class="form-label hint" for="form2Example27"
                          >Password</label
                        >
                      </div>
                    </form>

                    <div class="pt-1 mb-4">
                      <router-link
                        :to="{ name: 'beranda' }"
                        class="btn btn-dark btn-lg btn-block"
                        >Login</router-link
                      >
                    </div>
                    <!-- <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account?
                        <router-link :to="{ name: 'register' }" class="btn btn-primary">Register Here</router-link>
                    </p> -->
                    <p href="#!" class="small text-muted">Privacy policy</p>
                    <a href="#!" class="small text-muted"
                      >PT. Kilang Internasional Pertamina RU VII Kasim</a
                    >
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
import axios from "axios";
// import { getAuth, signInWithEmailAndPassword } from "firebase/auth";
export default {
  // import { reactive, ref } from 'vue'
  // import { useRouter } from 'vue-router'
  // import { useToast } from "vue-toastification";

  data() {
    return {
      image: {
        backgroundImage:
          "https://media.tenor.com/9vRAkntogEMAAAAd/background.gif",
      },
    };
  },
  mounted() {
    window.history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
      window.history.pushState(null, null, window.location.href);
    };
  },
  methods: {
    login() {
      axios
        .post("/login", {
          nama: this.nama,
          password: this.password,
        })
        .then((response) => {
          console.log(response);
          // redirect to dashboard or home page after successful login
        })
        .catch((error) => {
          console.error(error);
          // handle login error
        });
    },
  },

  //       login(submitEvent) {
  //       this.email = submitEvent.target.elements.email.value;
  //       this.password = submitEvent.target.elements.password.value;
  //       const auth = getAuth();
  //       signInWithEmailAndPassword(auth, this.email, this.password)
  //         .then(() => {
  //           this.$router.push("/beranda");
  //         })
  //         .catch((error) => {
  //           const errorCode = error.code;
  //           const errorMessage = error.message;
  //           console.log(errorCode);
  //           console.log(errorMessage);
  //           let alert_1 = document.querySelector("#alert_1");
  //           alert_1.classList.remove("d-none");
  //           alert_1.innerHTML = errorMessage;
  //           console.log(alert_1);
  //         });
  //     },
  //     moveToRegister() {
  //       this.$router.push("/register");
  //     },
  //   },

  //   setup() {

  // inisialisasi vue router on Composition API
  // const router = useRouter()

  // //state user
  // const user = reactive({
  //     nama: '',
  //     password: '',
  // })

  // //state validation
  // const validation = ref([])

  // //state loginFailed
  // const loginFailed = ref(null)

  // let toast = useToast();

  // //method login
  // function login() {
  //     //send server with axios
  //     axios
  //         .post("http://localhost:8000/api/pegawai")
  //         .then((response) => {
  //         if (response.data.success) {
  //             toast.success("Berhasil Login !",{
  //                 timeout: 2000
  //             })
  //             //set token
  //             localStorage.setItem("id", response.data.user.id);
  //             localStorage.setItem("token", response.data.access_token);
  //         }

  //         //set state loggedIn to true
  //         })
  //         .catch((error) => {
  //             loginFailed.value = true
  //         //set validation dari error response
  //         validation.value = error.response.data;
  //         });
  // }

  // return {
  //     user,           // <-- state user
  //     validation,     // <-- state validation
  //     loginFailed,    // <-- state loggedIn
  //     login           // <-- method login
  // }
};
const inputs = document.querySelectorAll(".form-control");
inputs.forEach((input) => {
  input.addEventListener("focus", () => {
    const label = input.nextElementSibling;
    if (label.classList.contains("hint")) {
      label.style.display = "inline";
    }
  });

  input.addEventListener("blur", () => {
    const label = input.nextElementSibling;
    if (label.classList.contains("hint")) {
      label.style.display = "none";
    }
  });
});
</script>

<style>
.moving-text {
  font-weight: bold;
  font-family: "Your-Preferred-Font", sans-serif; /* Replace 'Your-Preferred-Font' with the actual font you want to use */
  animation: moveText 2s linear infinite alternate,
    sparkle 1s linear infinite alternate; /* Adjust animation properties as needed */
  color: transparent;
  background-image: linear-gradient(45deg, #ff0000, #00ff00, #0000ff, #ff0000);
  background-size: 200% 200%;
  -webkit-background-clip: text;
  background-clip: text;
}

.bigger-text {
  font-size: 1.1em;
}

@keyframes moveText {
  0% {
    transform: translateY(10px);
  }
  100% {
    transform: translateY(-10px);
  }
}

@keyframes sparkle {
  0% {
    background-position: 0% 50%;
  }
  100% {
    background-position: 100% 50%;
  }
}

.custom-navbar {
  background-color: #f1f1f1; /* Replace 'YourColor' with your desired color code or name */
  /* Additional styles if needed */
}
</style>
