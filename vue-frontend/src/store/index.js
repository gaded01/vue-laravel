import router from "@/router";
import axios from "axios";
import { createStore } from "vuex";
import UserHTTP from "@/http/user";

export default createStore({
  state: {
    data: null,
    info: null,
    form: null,
    users: null,
    updateDialog: false,
    pokemon: [],
    pokemon_page: null,
    like_pokemon: [],
    hate_pokemon: [],
    fav_pokemon: {},
  },

   mutations: {
      setData(state, value) {
         state.data = value;
      },
      setInfo(state, value) {
         state.info = value;
      },
      setUser(state, value) {
         state.users = value;
      },
      setForm(state, value) {
         state.form = value;
      },
      setPokemonPage(state, value){
         state.pokemon_page = value;
      },
      setPokemon(state, value) {
         state.pokemon = value;
      },
      setLikePokemon(state, value) {
         state.like_pokemon.push(value);
      },
      setHatePokemon(state, value) {
         state.hate_pokemon.push(value);
      },
      setFavPokemon(state, value) {
         state.fav_pokemon = value;
      },
      setUpdateDialog(state, value) {
         state.updateDialog = value;
      },
      cleanUp(state) {
         state.hate_pokemon = [];
         state.like_pokemon = [];
         state.fav_pokemon = {};
      },
   },

   actions: {
      async loginUser({ commit }, form) {
         const data = await UserHTTP.login(form);
         console.log(data.user)
         await localStorage.setItem("token", data.access_token);
         router.push("/home");
      },

      async info({ commit }) {
         const data = await UserHTTP.info();
         commit("setData", data);
      },
    
      async pokemon({commit}, offset) {
         const { data } = await axios.get(`https://pokeapi.co/api/v2/pokemon?offset=${offset}&limit=10",` );
         commit("setPokemon", data.results);
         commit("setPokemonPage", data);
      },
   
      // pokemon api
      async fetchPokemon({commit}, {mutation, pokemon}) {
         const { data } = await axios.get(`https://pokeapi.co/api/v2/pokemon/${pokemon}`);
         commit(mutation, data)
      },

      async likePokemon({commit, dispatch}) {
         const data = await UserHTTP.likedPokemon();
         if(data) {
            data.forEach((element) => { 
               dispatch({type: 'fetchPokemon', mutation: "setLikePokemon" ,pokemon: element.pokemon_name});
            });
         }
      },
   async hatePokemon({commit, dispatch}) {
      const data = await UserHTTP.hatedPokemon();
      if(data) {
         data.forEach((element) => { 
            dispatch({type: 'fetchPokemon', mutation: "setHatePokemon" ,pokemon: element.pokemon_name});
         });
      }
     
   },
   async favPokemon({commit, dispatch}) {
      const data = await UserHTTP.favedPokemon();
      if(data)
      dispatch({type: 'fetchPokemon', mutation: "setFavPokemon" ,pokemon: data.pokemon_name});
    
   },

   async storeFavoritePokemon({commit}, param) {
      await UserHTTP.storeFavPokemon(param);
      
      return true
   },

   async storeHatePokemon({commit}, param) {
      await UserHTTP.storeHatePokemon(param);
      return true
   },

   async storeLikePokemon({commit}, param) {
      await UserHTTP.storeLikePokemon(param);
      return true
   },

   async removeFavoritePokemon({commit}, param) {
      await UserHTTP.removeFavPokemon(param);
      await dispatch('pokemon', 0)
      return true
   },
   
   async removeLikePokemon({commit}, param) {
      await UserHTTP.removeLikePokemon(param);
      return true
   },

   async removeHatePokemon({commit}, param) {
      await UserHTTP.removeHatePokemon(param);
      return true
   },

   async allUser({commit, dispatch}) {
      const data = await UserHTTP.all();
      commit('setUser', data);
   },
   
   async userInfo({commit, dispatch}, id) {
      const data = await UserHTTP.allInfo(id);
      commit('setInfo', data);
      if(data) {
         if(data.pokemon_favorite) 
            dispatch({type: 'fetchPokemon', mutation: "setFavPokemon" ,pokemon: data.pokemon_favorite.pokemon_name});
         if(data.pokemon_hate){
            data.pokemon_hate.forEach((res)=>{
               dispatch({type: 'fetchPokemon', mutation: "setHatePokemon" ,pokemon: res.pokemon_name});
            })
         }
         if(data.pokemon_like){
            data.pokemon_like.forEach((res)=>{
               dispatch({type: 'fetchPokemon', mutation: "setLikePokemon" ,pokemon: res.pokemon_name});
            })
         }
      }
   },

   async updateInfo({state, commit}) {
      const data = await UserHTTP.updateInfo(state.data);
      commit('setUpdateDialog', false);
   },

   async logout({commit}) {
      await UserHTTP.logout()
      await localStorage.clear();
      commit('setData', null);
   }

  },

});
