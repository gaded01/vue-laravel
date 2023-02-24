<script setup>
   import { computed, defineProps } from 'vue';
   import { useStore } from 'vuex';
   import UpdateProfile from './UpdateProfileDialog.vue';

   const props = defineProps(['user', 'update'])

</script>

<template>
   <VCard 
      title="Trainer Profile" 
      subtitle="Details of the trainer are the following"
      class="position-relative"
   >
      <VCardText> 
         <p><b>Trainer's name:</b> {{props.user?.firstname + " " + props.user?.lastname}}</p>
         <p><b>Birthdate:</b> {{props.user?.formatted_birthdate}}</p>
         <p><b>Gender:</b> {{props.user?.formatted_gender}}</p>  
      </VCardText>
      <VCardActions>
         <UpdateProfile v-show="update" :info="props.user"/> 
      </VCardActions>
   </VCard>
</template>
