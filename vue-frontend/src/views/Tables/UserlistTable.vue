<script setup>
import router from "@/router";
import { computed, onMounted, ref ,reactive} from 'vue';
import { storeKey, useStore } from 'vuex';
import triangleDark from '@/assets/logo.png'
const store = useStore();

const users = computed(()=> store.state.users);

onMounted(async() => {
  store.dispatch('allUser') 
})

</script>

<template>
  <VTable >
    <thead>
      <tr>
        <th class="text-center text-uppercase">
          Name
        </th>
        <th class="text-center text-uppercase">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="user in users"
        :key="user.id"
      >
        <td class="text-center">
          <p class="text-capitalize"> {{ user.firstname + " " + user.lastname }} </p>
        </td>
        <td class="text-center">
         <v-row justify="center">
            <VBtn
               @click="router.push({ path: `/trainer/${user.id}` });"
               variant="flat"
               color="red"
               size="small"
            >  
               View Profile
            </VBtn>
         </v-row>
        </td>
      </tr>
    </tbody>
  </VTable>
</template>
