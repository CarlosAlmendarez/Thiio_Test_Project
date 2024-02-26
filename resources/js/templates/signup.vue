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
          density="compact"
          placeholder="User name"
          prepend-inner-icon="mdi-email-outline"
          variant="outlined"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis">Email</div>
  
        <v-text-field
          density="compact"
          placeholder="Enter your Email"
          prepend-inner-icon="mdi-email-outline"
          variant="outlined"
        ></v-text-field>
  
        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Password
        </div>
        
        <v-text-field
          :append-inner-icon= ' "visible" ? "mdi-eye-off" : "mdi-eye"'
          :type= "'visible' ? 'text' : 'password'"
          density="compact"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          @click:append-inner= "'visible = !visible'"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Confirm Password
        </div>
  
        <v-text-field
          :append-inner-icon= ' "visible" ? "mdi-eye-off" : "mdi-eye"'
          :type= "'visible' ? 'text' : 'password'"
          density="compact"
          placeholder="Confirm your password"
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