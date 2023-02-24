<script setup>
   import UserlistTable from '@/views/Tables/UserlistTable.vue';
   import { computed , onMounted } from 'vue';
   import { useStore } from 'vuex';


   const store = useStore();

   const user = computed(()=> store.state.users);
   const fav_pokemon = computed(()=> store.state.fav_pokemon);
   const like_pokemon = computed(()=> store.state.like_pokemon);
   const hate_pokemon = computed(()=> store.state.hate_pokemon);

   onMounted(() => {
      store.dispatch('allUser')
   })

</script>
<template lang="">
   <VCol cols="12">
      <VCard title="List of other users">
         <UserlistTable/>
      </VCard>
   </VCol>
</template>

<style lang="">
   
</style>