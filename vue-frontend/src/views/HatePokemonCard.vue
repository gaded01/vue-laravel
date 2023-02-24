<script setup>
   import { useStore } from 'vuex';
  
   const store = useStore();
   const props = defineProps(['hate_pokemon'])

</script>
<template>
   <VCard>
      <VCardItem>
         <VCardTitle>Hate Pokemon</VCardTitle>
         <VCardSubtitle>List of the pokemons you hate</VCardSubtitle>
       
      </VCardItem>
      <VCardText>
         <VRow>
            <VCol
               v-for="pokemon in props.hate_pokemon"
               :key="pokemon.name" 
               cols="6"
               sm="3"
            >
               <div class="d-flex align-center">
                  <div class="me-3">
                 
                     <VImg
                        :width="80"
                        aspect-ratio="16/9"
                        cover
                        :src="pokemon.sprites.front_default" 
                     />
                  </div>

                  <div class="d-flex flex-column">
                  <span class="text-caption">
                     PokemonId# {{ pokemon.id }} 
                  </span>
                  <span class="text-h6 text-capitalize font-weight-small">{{ pokemon.name }}</span>
                  </div>
               </div>
            </VCol>
         </VRow>
      </VCardText>
   </VCard>
</template>
