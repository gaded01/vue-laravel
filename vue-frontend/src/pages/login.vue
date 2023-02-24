<script setup>
import { ref, reactive } from "vue";
import { useStore } from 'vuex';


const form = reactive({
  username: "",
  password: "",
});

const store = useStore()

const isPasswordVisible = ref(false);
</script>

<template>
  <div class="auth-wrapper d-flex align-center justify-center pa-4">
    <VCard class="auth-card pa-4 pt-7" max-width="448">
      <VCardText class="pt-2">
        <h5 class="text-h5 font-weight-semibold mb-1">Login Here!</h5>
        <p class="mb-0">
          Please sign-in to your account and start the adventure
        </p>
      </VCardText>

      <VCardText>
        <VForm @submit.prevent="() => {}">
          <VRow>
            <VCol cols="12">
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
              <VBtn block size="large" type="submit" @click="store.dispatch('loginUser', form)">
                Login
              </VBtn>
            </VCol>
            <VCol cols="12" class="text-center text-base">
              <span>Doesn't have account?</span>
              <RouterLink class="text-primary ms-2" :to="{ name: 'Register' }">
                Create an account
              </RouterLink>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </div>
</template>

<style lang=""></style>
