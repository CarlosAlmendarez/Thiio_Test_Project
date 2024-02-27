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

    <v-card
      class="mx-auto ma-6"
      width="400"
      prepend-icon="mdi-account-circle"
    >
      <template v-slot:title>
        This is a title
      </template>

      <v-card-text>
        '@json($besitzers)'
      </v-card-text>
    </v-card>

  </template>