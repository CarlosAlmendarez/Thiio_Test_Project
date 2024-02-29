<template>
    <div>
      <v-img
        class="mx-auto my-6"
        max-width="140"
        src="https://cdn-icons-png.flaticon.com/512/6159/6159448.png"
      ></v-img>
  
      <v-card 
        class="mx-auto pa-12 pb-8"
        elevation="8"
        max-width="448"
        rounded="lg"
      >
        <div class="text-subtitle-1 text-medium-emphasis">Name</div>
  
        <v-text-field
          v-model="name"
          density="compact"
          placeholder="User name"
          prepend-inner-icon="mdi-email-outline"
          :rules="nameRules"
          variant="outlined"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis">Email</div>
  
        <v-text-field
          v-model="email"
          density="compact"
          placeholder="Enter your Email"
          prepend-inner-icon="mdi-email-outline"
          variant="outlined"
          :rules="emailRules"
        ></v-text-field>
  
        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Password
        </div>
        
        <v-text-field
          v-model="password"
          :append-inner-icon= ' "visible" ? "mdi-eye-off" : "mdi-eye"'
          :type= "'visible' ? 'text' : 'password'"
          density="compact"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          :rules="passwordRules"
          @click:append-inner= "'visible = !visible'"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Confirm Password
        </div>
  
        <v-text-field
          v-model="password_confirmation"
          :append-inner-icon= ' "visible" ? "mdi-eye-off" : "mdi-eye"'
          :type= "'visible' ? 'text' : 'password'"
          density="compact"
          placeholder="Confirm your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          :rules="passwordRules"
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
          Sign Up
        </v-btn>
  
        <v-card-text class="text-center">
          <a
            class="text-blue text-decoration-none"
            href="/"
            rel="noopener noreferrer"
          >
            Alredy have an account? Log In <v-icon icon="mdi-chevron-right"></v-icon>
          </a>
        </v-card-text>
      </v-card>
    </div>
  </template>

  
<script>
export default {
  data: () => ({
    email: '',
    password: '',
    password_confirmation: '',
    name: '',
    nameRules: [
      (v) => !!v || 'Name is required',
      (v) => (v && v.length <= 10) || 'Name must be less than 10 characters',
      ],
      emailRules: [
        (v) => !!v || 'Email is required',
        (v) => /.+@.+\..+/.test(v) || 'Email must be valid',
      ],
      passwordRules: [
        (v) => !!v || 'Password is required',
        (v) => (v && v.length >= 8) || 'Password must be at least 8 characters',
      ],
  }),
  methods: {
    validate() {
        
      let data = { name: this.name, email: this.email, password: this.password , password_confirmation:  this.password_confirmation}
      axios.post('http://127.0.0.1:8000/api/register', data)
      .then(function (response) {
        console.log(response);

        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

        window.location.href = "http://127.0.0.1:8000/dashboard?token="+response.data.token
      })
      .catch(function (error) {
        console.log(error);
      });
      
      }
    }
  }
</script>