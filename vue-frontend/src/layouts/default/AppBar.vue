<script setup>
import { useStore } from 'vuex';
import {computed } from 'vue';
import router from '@/router';

const store = useStore();

const user = computed(()=> store.state.data);

async function destroyToken(){
    await store.dispatch('logout');
    localStorage.removeItem('token')
    router.push({ path: "/" });
}
</script>

<template>
  <v-app-bar flat>
    <v-app-bar-title>
      <!-- <v-icon icon="mdi-circle-slice-4" /> -->
      Pokemon Adventure
    </v-app-bar-title>

    <v-spacer></v-spacer> 
    <v-btn v-if="user" variant="outlined" @click="router.push({ name: 'Pokemons' })">
        Find Pokemon
    </v-btn>
    <v-btn v-if="user" variant="flat" @click="router.push({ name: 'Home' })">
        My Profile
    </v-btn>
    <v-btn v-if="user" variant="flat" @click="router.push({ name: 'Trainers' })">
        Other Trainers
    </v-btn>
    <v-btn icon v-if="user" @click="destroyToken">
      <v-icon>mdi-export</v-icon>
    </v-btn>
  </v-app-bar>
</template>

