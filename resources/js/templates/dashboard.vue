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
      <template v-slot:default="{ items, isExpanded, toggleExpand }">
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
                  :color="item.raw.color"
                  :icon="item.raw.icon"
                  start
                  size="18"
                ></v-icon>

                <h4>{{ item.raw.name }}</h4>
              </v-card-title>

              <v-card-text>
                {{ item.raw.description }}
              </v-card-text>

              <div class="px-4">
                <v-switch
                  :model-value="isExpanded(item)"
                  :label="`${isExpanded(item) ? 'Hide' : 'Show'} details`"
                  density="compact"
                  inset
                  @click="() => toggleExpand(item)"
                ></v-switch>
              </div>

              <v-divider></v-divider>

              <v-expand-transition>
                <div v-if="isExpanded(item)">
                  <v-list density="compact" :lines="false">
                    <v-list-item :title="`🔥 Calories: ${item.raw.calories}`" active></v-list-item>
                    <v-list-item :title="`🍔 Fat: ${item.raw.fat}`"></v-list-item>
                    <v-list-item :title="`🍞 Carbs: ${item.raw.carbs}`"></v-list-item>
                    <v-list-item :title="`🍗 Protein: ${item.raw.protein}`"></v-list-item>
                    <v-list-item :title="`🧂 Sodium: ${item.raw.sodium}`"></v-list-item>
                    <v-list-item :title="`🦴 Calcium: ${item.raw.calcium}`"></v-list-item>
                    <v-list-item :title="`🧲 Iron: ${item.raw.iron}`"></v-list-item>
                  </v-list>
                </div>
              </v-expand-transition>
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
    }),
    mounted() {
      console.log(window.posts);
    }
  }
</script>