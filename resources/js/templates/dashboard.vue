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
  
        <v-btn append-icon="mdi-logout">
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
                            <v-text-field :rules="nameRules" label="Name" required hide-details></v-text-field>
                          </v-col>
                          <v-col>
                            <v-text-field :rules="emailRules" label="Email" hide-details required></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col>
                            <v-text-field :rules="passwordRules" label="Password" hide-details required></v-text-field>
                          </v-col>
                          <v-col>
                            <v-text-field :rules="passwordRules" label="Confirm Password" hide-details required></v-text-field>
                          </v-col>
                        </v-row>
                        <div>
                          <v-row>
                            <v-col>
                              <div class="text-center">
                                <v-btn
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
        <v-data-iterator :items="users" item-value="name">
          <template v-slot:default="{ items, toggleEnabled }">
            <v-row>
              <v-col v-for="item in items" :key="item.enabled" cols="12" sm="12" md="6">
                <v-card>
                  <v-card-title class="d-flex align-center">
                    <v-icon icon="mdi-account" start size="18"></v-icon>
                    <h4>Username: {{ item.raw.name }}</h4>
                  </v-card-title>
                  <div class="px-4">
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                            <v-text-field v-model="item.raw.name" :rules="nameRules" label="Name" required hide-details></v-text-field>
                          </v-col>
                          <v-col>
                            <v-text-field v-model="item.raw.email" :rules="emailRules" label="Email" hide-details required></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col>
                            <v-text-field :rules="passwordRules" label="Password" hide-details required></v-text-field>
                          </v-col>
                          <v-col>
                            <v-text-field :rules="passwordRules" label="Confirm Password" hide-details required></v-text-field>
                          </v-col>
                        </v-row>
                        <div>
                          <v-row>
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
                                  @click="updateUser(item)"
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
  data: () => ({
    users: window.posts,
    enabledUsers: {}, // Objeto para almacenar el estado de habilitación por usuario
    valid: true, // Variable de validación
    passwordModel: '', // Modelo de contraseña
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
    updateUser(user) {
      // Aquí puedes implementar la lógica para actualizar el usuario en tu backend
      console.log('Actualizando usuario:', user);
    },
  },
};
</script>
