<script setup>
import router from "@/router";
import {useRoute} from "vue-router";
import TrainerCard from '@/views/TrainerCard.vue'
import LikePokemonCard from '@/views/LikePokemonCard.vue'
import FavoritePokemonCard from '@/views/FavoritePokemonCard.vue'
import HatePokemonCard from '@/views/HatePokemonCard.vue'
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';
const store = useStore();
const route = useRoute();

const user = computed(()=> store.state.info);
const like_pokemon = computed(()=> store.state.like_pokemon);
const hate_pokemon = computed(()=> store.state.hate_pokemon);
const fav_pokemon = computed(()=> store.state.fav_pokemon);

onMounted(async () => {
   await store.commit('cleanUp')
   await store.dispatch('userInfo',route.params.id)
})
</script>

<template>
   <VContainer
      class="spacing-playground pa-6"  
      fluid
   >  
      <VRow class="match-height">
         <VCol
            cols="12"
            md="4"
         >
           <TrainerCard :user="user" :update="false"/>
         </VCol>
         <VCol
            cols="12"
            md="8"
         >
           <LikePokemonCard :like_pokemon="like_pokemon"/>
         </VCol>
         <VCol
            cols="12"
            md="4"
         >
            <FavoritePokemonCard :fav_pokemon="fav_pokemon"/>
         </VCol>

         <VCol
            cols="12"
            md="8"
         >
            <HatePokemonCard :hate_pokemon="hate_pokemon"/>
         </VCol>
      </VRow>
   </VContainer>
  
</template>

