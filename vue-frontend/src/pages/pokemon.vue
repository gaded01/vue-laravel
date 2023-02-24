<script setup>
import TableCard from '@/views/Tables/PokemonTable.vue';
import { computed, onMounted, ref, reactive } from 'vue';
import { useStore } from 'vuex';
import triangleDark from '@/assets/logo.png'
const store = useStore();
const pokemon_page = computed(()=> store.state.pokemon_page);
let offset = reactive(0);

function nextPage() {
   offset += 10;
   store.dispatch('pokemon', offset)
}

function prevPage() {
   offset -= 10;
   store.dispatch('pokemon', offset)
}


</script>
<template lang="">
   <VCol cols="12">
    <VCard title="List of Pokemons">
      <TableCard />
      <VCardActions class="d-flex flex-row-reverse justify-space-between">
         <VBtn @click="nextPage">
            Next Page
         </VBtn>

         <VBtn v-if="pokemon_page?.previous != null" @click="prevPage">
            Previous Page
         </VBtn>
      </VCardActions>
    </VCard>
 </VCol>
</template>
<style lang="">
   
</style>