<script setup>
import Datepicker from 'vuejs3-datepicker';
import { useStore } from 'vuex'
import { ref, reactive, computed } from "vue";
const store = useStore();
const dialog = ref(false);
const props = defineProps(['info'])
const user = computed(()=> store.state.data);
const form = computed({
  get() {
    return store.state.data 
  },
  set(value) {
   store.commit(setForm, value)
  }
});

</script>
<template>
  <div class="text-center">
    <VDialog v-model="dialog" width="400">
      <template v-slot:activator="{ props }">
        <VBtn block color="primary" v-bind="props"> Update Details </VBtn>
      </template>
      <VCard>
        <VCardText>
          <VForm @submit.prevent="() => {}">
            <VRow>
              <VCol cols="12">
                <v-text-field
                  v-model="form.firstname"
                  label="Firstname"
                  variant="outlined"
                />
                <VTextField
                  v-model="form.lastname"
                  label="Lastname"
                  variant="outlined"
                />
              
                 <input 
                    type="date" 
                    v-model="form.birthdate"
                    class="input-date w-100 mb-6 py-3 px-2"
                  >
                
            
                <VSelect
                  v-model="form.gender"
                  :items="[
                    { id: '1', name: 'Male' },
                    { id: '2', name: 'Female' },
                  ]"
                  item-title="name"
                  item-value="id"
                  label="Select"
                  variant="outlined"
                />
                <VTextField
                  v-model="form.username"
                  label="Username"
                  type="username"
                  variant="outlined"
                />
                <VTextField
                  v-model="form.password"
                  label="Password"
                  type="password"
                  variant="outlined"
                />
                <VBtn block size="large" type="submit" @click="() => {
                  store.dispatch('updateInfo');
                  dialog = false
                }">
                  Update Profile
                </VBtn>
              </VCol>
              
            </VRow>
          </VForm>
        </VCardText>
        <VCardActions>
          <VBtn color="primary" block @click="dialog = false"
            >Close Dialog</VBtn
          >
        </VCardActions>
      </VCard>
    </VDialog>
  </div>
</template>
<style>
  .input-date {
    border: 1px solid rgb(157, 156, 156);
    border-radius: 5px;
    border-color: gray;
  }
</style>