import axios from 'axios';
const api = import.meta.env.VITE_API_KEY

const UserHTTP = (()=> {

   const login = async (form) => {
      const { data } = await axios.post(`${api}/user/login`, form);
      return data;
   }

   const logout =  async () => {
      const { data } = await axios.post(`${api}/user/logout`, {}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const info = async () => {
      const { data } = await axios.get(`${api}/user/info`, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const allInfo = async (id) => {
      const { data } = await axios.get(`${api}/user/${id}`, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const updateInfo =  async (param) => {
      const { data } = await axios.post(`${api}/user/update`, param, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const all = async () => {
      const { data } = await axios.get(`${api}/user/all`, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }
   
   const likedPokemon = async () => {
      const { data } = await axios.post(`${api}/user/like-pokemon`, {}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const hatedPokemon = async () => {
      const { data } = await axios.post(`${api}/user/hate-pokemon`, {}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const favedPokemon = async () => {
      const { data } = await axios.post(`${api}/user/fav-pokemon`, {}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const storeFavPokemon = async (param) => {
      const { data } = await axios.post(`${api}/user/store-fav-pokemon`, {pokemon_name: param}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const storeHatePokemon = async (param) => {
      const { data } = await axios.post(`${api}/user/store-hate-pokemon`, {pokemon_name: param}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const storeLikePokemon = async (param) => {
      const { data } = await axios.post(`${api}/user/store-like-pokemon`, {pokemon_name: param}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const removeFavPokemon = async (param) => {
      const { data } = await axios.post(`${api}/user/remove-fav-pokemon`, {pokemon_name: param}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const removeHatePokemon = async (param) => {
      const { data } = await axios.post(`${api}/user/remove-hate-pokemon`, {pokemon_name: param}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   const removeLikePokemon = async (param) => {
      const { data } = await axios.post(`${api}/user/remove-like-pokemon`, {pokemon_name: param}, {
         headers: { Authorization: `Bearer ${localStorage.getItem('token')}`}
      });
      return data
   }

   return {allInfo, updateInfo, likedPokemon, favedPokemon, login,  info, logout, all, removeLikePokemon, removeHatePokemon, removeFavPokemon , storeLikePokemon, storeHatePokemon, storeHatePokemon, storeFavPokemon, hatedPokemon};
})();

export default UserHTTP;
