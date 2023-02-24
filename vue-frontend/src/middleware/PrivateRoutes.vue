<script>
import router from "@/router";
import store from "@/store";
import { useStore } from "vuex";
import { onMounted, computed } from "vue";
import Default from "../layouts/default/AppBar";

export default {
  setup() {
    const store = useStore();

    if (!localStorage.getItem("token")) {
      router.push({ path: "/" });
    }

    const validateCheck = async () => {
      console.log('weee')
      const success = computed(() => store.dispatch('info'));

      if (!success) {
        localStorage.removeItem("token");
        router.push({ path: "/" });
        return;
      }
      else{
        store.dispatch('info')
      }
    };
    onMounted(() => {
      validateCheck();
    });
  },
};
</script>

<template>
  <router-view></router-view>
</template>
