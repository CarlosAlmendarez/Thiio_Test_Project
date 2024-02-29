<template>
    <div>
      <v-toolbar
        dark
        prominent
        image="https://images.pexels.com/photos/1103970/pexels-photo-1103970.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
        class="text-white"
      > 
        <v-toolbar-title>Dashboard</v-toolbar-title>
  
        <v-spacer></v-spacer>
  
        <v-btn 
        @click="logOut()"
        append-icon="mdi-logout">
            Log Out
        </v-btn>
      </v-toolbar>
    </div>
    <v-row>
      <v-col>

        <div class="text-center text-h2 ma-5 pa-2"> Create new user </div>

        <v-card>
                  <v-card-title class="d-flex align-center">
                    <v-icon icon="mdi-account" start size="18"></v-icon>
                    <h4>New User info</h4>
                  </v-card-title>
                  <div class="px-4">
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                            <v-text-field v-model="new_name" :rules="nameRules" label="Name" required hide-details></v-text-field>
                          </v-col>
                          <v-col>
                            <v-text-field v-model="new_email" :rules="emailRules" label="Email" hide-details required></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col>
                            <v-text-field v-model="new_password" :rules="passwordRules" label="Password" hide-details required></v-text-field>
                          </v-col>
                          <v-col>
                            <v-text-field v-model="new_confirmpassword" :rules="passwordRules" label="Confirm Password" hide-details required></v-text-field>
                          </v-col>
                        </v-row>
                        <div>
                          <v-row>
                            <v-col cols="12">
                              <v-alert v-if="showAlert" type="success" dismissible>
                                {{ alertMessage }}
                              </v-alert>
                            </v-col>
                            <v-col>
                              <div class="text-center">
                                <v-btn
                                 @click="createUser()"
                                  append-icon="mdi-account-plus"
                                >
                                  Create New User
                                  <template v-slot:append>
                                    <v-icon color="blue"></v-icon>
                                  </template>
                                </v-btn>
                              </div>
                            </v-col>
                          </v-row>
                        </div>
                      </v-container>
                    </v-form>
                  </div>
                </v-card>

      </v-col>
      <v-col>
        <div class="text-center text-h2 ma-5 pa-2"> Update Users </div>
        <v-data-iterator :pagination.sync="pagination" :items-per-page="itemsPerPage" :items="users" item-value="name">
          <template v-slot:default="{ items }">
            <v-row>
              <v-col v-for="item in items" :key="item.enabled" cols="12" sm="12" md="6">
                <v-card v-if="item.raw.showElement=true">
                  <v-card-title class="d-flex align-center">
                    <v-icon icon="mdi-account" start size="18"></v-icon>
                    <h4>Username: {{ item.raw.name }}</h4>
                  </v-card-title>
                  <div class="px-4">
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                            <v-text-field v-model="item.raw.name" :namepreviousvalue="item.raw.name" :rules="nameRules" label="Name" required hide-details></v-text-field>
                          </v-col>
                          <v-col>
                            <v-text-field v-model="item.raw.email" :emailpreviousvalue="item.raw.email" :rules="emailRules" label="Email" hide-details required></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col>
                            <v-text-field v-model="item.raw.password" :rules="passwordRules" label="Password" hide-details required></v-text-field>
                          </v-col>
                        </v-row>
                        <div>
                          <v-row>
                            <v-col cols="12">
                              <v-alert v-if="item.raw.showAlert" type="success" dismissible>
                                {{ item.raw.alertMessage }}
                              </v-alert>
                              <v-alert v-if="item.raw.showErrorAlert" type="error" dismissible>
                                {{ item.raw.alertMessage }}
                              </v-alert>
                            </v-col>
                            <v-col>
                              <div class="text-center">
                                <v-btn
                                  @click="updateUser(item)"
                                  append-icon="mdi-pencil"
                                >
                                  Update user info
                                  <template v-slot:append>
                                    <v-icon color="success"></v-icon>
                                  </template>
                                </v-btn>
                              </div>
                            </v-col>
                            <v-col>
                              <div class="text-center">
                                <v-btn
                                  @click="deleteUser(item)"
                                  append-icon="mdi-trash-can"
                                >
                                  Delete User
                                  <template v-slot:append>
                                    <v-icon color="red"></v-icon>
                                  </template>
                                </v-btn>
                              </div>
                            </v-col>
                          </v-row>
                        </div>
                      </v-container>
                    </v-form>
                  </div>
                </v-card>
              </v-col>
            </v-row>
          </template>
        </v-data-iterator>
      </v-col>
    </v-row>
</template>

<script>
export default {
  data() {
  return {
    users: window.posts,
    enabledUsers: {},
    valid: false,
    new_name: '',
    new_email: '',
    new_password: '',
    new_confirmpassword: '',
    showAlert: false,
    alertMessage: '',
    itemsPerPage: -1,
    pagination: false,
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
  };
},
  methods: {
    updateUser(user) {
      let data = { id: user.raw.id, name: user.raw.name, email: user.raw.email, password: user.raw.password, password_confirmation: user.raw.password }
      let params = new URLSearchParams(document.location.search);
      let token = params.get("token");
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        axios.post('http://127.0.0.1:8000/api/update', data)
        .then(function (response) {
          user.raw.showAlert = true;
          user.raw.alertMessage = response.data.message;
          setTimeout(() => {
            user.raw.showAlert = false;
          }, 3000)

        })
        .catch(function (error) {
          user.raw.showErrorAlert = true;
          user.raw.alertMessage = error.response.data.message;
          setTimeout(() => {
            user.raw.showErrorAlert = false;
          }, 3000)
        });
    },
    createUser() {
      let data = { name: this.new_name, email: this.new_email, password: this.new_password, password_confirmation: this.new_password }
        axios.post('http://127.0.0.1:8000/api/register', data)
        .then(function (response) {
          console.log(response);
          window.location.reload();

        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteUser(user){
      let params = new URLSearchParams(document.location.search);
      let token = params.get("token");
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      let data = { id: user.raw.id }
        axios.post('http://127.0.0.1:8000/api/delete', data)
        .then(function (response) {
          user.raw.showAlert = true;
          user.raw.alertMessage = response.data.message;
          setTimeout(() => {
            user.raw.showAlert = false;
            window.location.reload();
          }, 3000)
        })
        .catch(function (error) {
          user.raw.showErrorAlert = true;
          user.raw.alertMessage = error.response.data.message;
          setTimeout(() => {
            user.raw.showErrorAlert = false;
          }, 3000)
        });
    },
    logOut(){
      let params = new URLSearchParams(document.location.search);
      let token = params.get("token");
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        axios.get('http://127.0.0.1:8000/api/logout')
        .then(function (response) {
          window.location.href = "http://127.0.0.1:8000/"
        })
        .catch(function (error) {
          
        });
    }
  },
};
</script>
