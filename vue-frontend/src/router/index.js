// Composables
import { createRouter, createWebHistory } from "vue-router";
import auth from "../middleware/PrivateRoutes";

const routes = [
  {
    path: "/",
    component: () => import("@/layouts/default/Default.vue"),
    children: [
      {
        path: "",
        name: "Login",
        component: () => import("@/pages/login.vue"),
       
      },
      {
        path: "/register",
        name: "Register",
        component: () => import("@/pages/register.vue"),
       
      },
      {
        path: "/",
        component: () => import("@/middleware/PrivateRoutes.vue"),
        children: [
          {
            path: "/home",
            name: "Home",
            component: () => import( "@/pages/home.vue"),
            
          },
          {
            path: "/pokemon",
            name: "Pokemons",
            component: () => import( "@/pages/pokemon.vue"),
            
          },
          {
            path: "/trainers",
            name: "Trainers",
            component: () => import( "@/pages/trainers.vue"),
          },
          {
            path: "/trainer/:id",
            name: "TrainersProfile",
            component: () => import( "@/pages/user-profile.vue"),
          },
        ]
      }
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});


export default router;
