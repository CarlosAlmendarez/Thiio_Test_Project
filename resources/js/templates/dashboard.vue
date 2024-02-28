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

    <v-data-iterator
      :items="users"
      item-value="name"
    >
      <template v-slot:default="{ items, isExpanded, toggleExpand }" class="ma-2 pa-2 align-self-center">
        <v-row>
          <v-col
            v-for="item in items"
            :key="item.raw.name"
            cols="12"
            sm="12"
            md="6"
          >
            <v-card>
              <v-card-title class="d-flex align-center">
                <v-icon
                  start
                  size="18"
                ></v-icon>

                <h4>Name: {{ item.raw.name }}</h4>
              </v-card-title>

              <v-card-text>
                Email: {{ item.raw.email }}
              </v-card-text>

              <div class="px-4">
                <v-form v-model="valid">
                  <v-container>
                    <v-row>
                      <v-col
                        cols="12"
                        md="4"
                      >
                        <v-text-field
                          v-model="item.raw.name"
                          :rules="nameRules"
                          label="Name"
                          required
                          hide-details
                        ></v-text-field>
                        
                      </v-col>

                      <v-col
                      >
                        <v-text-field
                          v-model="item.raw.email"
                          :rules="emailRules"
                          label="E-mail"
                          hide-details
                          required
                        ></v-text-field>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col
                      >
                        <v-text-field
                          v-model="passwordModel"
                          :rules="passwordRules"
                          label="Password"
                          hide-details
                          required
                        ></v-text-field>
                      </v-col>
                    <v-col>
                        <v-text-field
                          v-model="passwordModel"
                          :rules="passwordRules"
                          label="Confirm Password"
                          hide-details
                          required
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-form>
              </div>

            </v-card>
          </v-col>
        </v-row>
      </template>
    </v-data-iterator>

  </template>

<script>
  export default {
    data: () => ({
      users: window.posts,
      toggle: [],
    }),
    mounted() {
      console.log(window.posts);
    }
  }
</script>