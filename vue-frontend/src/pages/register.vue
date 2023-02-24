<script setup>
import { ref , reactive} from "vue";
import axios from 'axios';
import router from '@/router';

const form = reactive({
  firstname: "",
  lastname: "",
  birthdate: "",
  gender: "",
  username: "",
  password: "",
});

async function registerUser() {
  console.log(form)
  await axios.post(`http://localhost:8000/api/user/register`, form)
  .then((res) => {
     router.push({ name: "Login" })
  })
}

</script>

<template>
  <div class="auth-wrapper d-flex align-center justify-center pa-4">
    <VCard class="auth-card pa-4 pt-7" max-width="448">
      <VCardText class="pt-2">
        <h5 class="text-h5 font-weight-semibold mb-1">Register Here!</h5>
        <p class="mb-0">
          Please fill-up the fields to register.
        </p>
      </VCardText>

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
                  class="input-date w-100 mb-6 py-4 px-2"
              >
                
               <VSelect
                  v-model="form.gender"
                  :items="[{id: '1',name: 'Male'}, {id: '2', name: 'Female'}]"
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
              <VBtn block size="large" type="submit" @click="registerUser"> Register </VBtn>
            </VCol>
            <VCol cols="12" class="text-center text-base">
              <span>Doesn't have account?</span>
              <RouterLink class="text-primary ms-2" :to="{ name: 'Login' }">
                Create an account
              </RouterLink>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </div>
</template>

<style>
  .input-date {
    border: 1px solid rgb(157, 156, 156);
    border-radius: 5px;
    border-color: gray;
  }
</style>
