<script setup>
import { computed, onMounted, ref ,reactive} from 'vue';
import { useStore } from 'vuex';
import triangleDark from '@/assets/logo.png'
const store = useStore();
const pokemons = computed(()=> store.state.pokemon);
const fav_pokemon = computed(()=> store.state.fav_pokemon);

let like = reactive([]);
let hate = reactive([]);

function pushLikeArr() {
   console.log('like', store.state.like_pokemon.length)
   for(let x = 0; x < store.state.like_pokemon.length; x++) {
      const pokemon = store.state.like_pokemon[x];
      like.push(pokemon.name)
      
   }
}
function pushHateArr() {
   for(let x = 0; x < store.state.hate_pokemon.length; x++) {
      const pokemon = store.state.hate_pokemon[x];
      hate.push(pokemon.name)
      console.log('log', hate)
   }
}

async function selectFavPokemon(param) {
   await store.dispatch('storeFavoritePokemon', param);
  
}
async function selectLikePokemon(param) {
   await store.dispatch('storeLikePokemon', param);

}
async function selectHatePokemon(param) {
   await store.dispatch('storeHatePokemon', param);
}


onMounted(async() => {
   await store.dispatch('pokemon', 0);
   await store.dispatch('hatePokemon');
   await store.dispatch('likePokemon');
   await store.dispatch('favPokemon');
   pushLikeArr();
   pushHateArr();
})

</script>

<template>
  <VTable >
    <thead>
      <tr>
        <th class="text-center text-uppercase">
          Pokemon
        </th>
      
        <th class="text-center text-uppercase">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="pokemon in pokemons"
        :key="pokemon.id"
      >
        <td class="text-center">
          <p class="text-capitalize"> {{ pokemon.name }} </p>
        </td>
   
        <td class="text-center">
         <v-row justify="center">
            <VBtn
              @click="selectFavPokemon(pokemon.name)"
               :icon="fav_pokemon.name == pokemon.name ? 'mdi-heart' : 'mdi-heart-outline'"
               variant="text"
               color="red"
               icon
            >
            </VBtn>
            <VBtn
            @click="selectLikePokemon(pokemon.name)"
               :icon="like.includes(pokemon.name) ? 'mdi-thumb-up' : 'mdi-thumb-up-outline'"
               variant="text"  
               color="blue-darken-2"
          
            >
            </VBtn>
            <VBtn
            @click="selectHatePokemon(pokemon.name)"
               :icon="hate.includes(pokemon.name) ? 'mdi-thumb-down' : 'mdi-thumb-down-outline'"
               variant="text"
               color="blue-darken-2"
              
            >
            </VBtn>
         </v-row>
        </td>
      </tr>
    </tbody>
  </VTable>
</template>
