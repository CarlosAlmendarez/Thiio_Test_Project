<template>
    <div>
      <v-img
        class="mx-auto my-6"
        max-width="180"
        src="https://icon-library.com/images/user-icon-png-transparent/user-icon-png-transparent-23.jpg"
      ></v-img>
  
      <v-card
        class="mx-auto pa-12 pb-8"
        elevation="8"
        max-width="448"
        rounded="lg"
      >
      <form id="login_form" method="POST" action="/api/login" aria-label="Login">

        <div class="text-subtitle-1 text-medium-emphasis">Email</div>
  
        <v-text-field
          v-model="email"
          v-validate="'required|min:6'"
          data-vv-name="email"
          density="compact"
          placeholder="Email address"
          prepend-inner-icon="mdi-email-outline"
          variant="outlined"
        ></v-text-field>
  
        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Password
        </div>
  
        <v-text-field
          v-model="password"
          v-validate="'required|min:6'"
          data-vv-name="password"
          :append-inner-icon= ' "visible" ? "mdi-eye-off" : "mdi-eye"'
          :type= "'visible' ? 'text' : 'password'"
          density="compact"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          @click:append-inner= "'visible = !visible'"
        ></v-text-field>
  
        <v-btn
          block
          class="mb-8"
          color="blue"
          size="large"
          variant="tonal"
          @click="validate"
        >
          Log In
        </v-btn>
      </form>
  
        <v-card-text class="text-center">
          <a
            class="text-blue text-decoration-none"
            href="/signup"
          >
            Sign up now <v-icon icon="mdi-chevron-right"></v-icon>
          </a>
        </v-card-text>
      </v-card>
    </div>
  </template>

<script>
  export default {
    data: () => ({
      email: '',
      password: ''
    }),
    methods: {
      validate() {
          
        let data = { email: this.email, password: this.password }
        axios.post('http://127.0.0.1:8000/api/login', data)
        .then(function (response) {
          console.log(response);
          window.location.href = "http://127.0.0.1:8000/dashboard"
        })
        .catch(function (error) {
          console.log(error);
        });
        
        }
      }
    }
</script>