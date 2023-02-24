<script setup>
   import { computed, onMounted } from 'vue';
   import { useStore } from 'vuex';


   const store = useStore();
   const props = defineProps(['fav_pokemon'])
   

   onMounted(async() => {
   })
</script>
<template>
   <VCard>
      <VCardItem>
         <VCardTitle>Favorite Pokemon</VCardTitle>
         <VCardSubtitle>Featuring your favorite pokemon</VCardSubtitle>
   
      </VCardItem>

      <VCardText>
         <VRow>
            <VCol
               cols="6"
               sm="3"
            >
               <div class="d-flex align-center">
                  <div class="me-3">
                     <VImg
                        :width="150"
                        aspect-ratio="1"
                        cover
                        :src="props.fav_pokemon.sprites?.front_default"
                     />
                  </div>

                  <div class="d-flex flex-column">
                  <span class="text-caption">
                     PokemonId# {{ props.fav_pokemon.id }} 
                  </span>
                  <span class="text-h6 text-capitalize font-weight-small">{{ props.fav_pokemon.name }}</span>
                  </div>
               </div>
            </VCol>
         </VRow>
         
      </VCardText>
   </VCard>
</template>
