<?php

namespace App\Http\Controllers;

use App\Models\PokemonFavorite;
use App\Models\PokemonHate;
use App\Models\PokemonLike;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function hatePokemon(Request $request) 
    {
      $pokemon = PokemonHate::where('user_id', $request->user()->id)->get();
      if($pokemon != null) {
         return $pokemon;
       };
       return;
    }

    public function likePokemon(Request $request) 
    {
       $pokemon = PokemonLike::where('user_id', $request->user()->id)->get();
       if($pokemon != null) {
         return $pokemon;
       };
       return;
    }

    public function favoritePokemon(Request $request) 
    {
      $pokemon =  PokemonFavorite::where('user_id', $request->user()->id)->first();
       if($pokemon != null) {
         return $pokemon;
       };
       return;
    }

    public function storeFavoritePokemon(Request $request)
    {
      $exists = PokemonHate::where('pokemon_name', $request->pokemon_name)->exists();

      if(@$exists) {
         PokemonHate::where('pokemon_name', $request->pokemon_name)->delete();
      } 

      return PokemonFavorite::updateOrCreate([
         'user_id' => $request->user()->id
      ],[
         'pokemon_name' => $request->pokemon_name
      ]);
    }

    public function removeFavPokemon(Request $request)
    { 
      return PokemonFavorite::where('pokemon_name', $request->pokemon_name)->delete();

    }
    public function storeLikePokemon(Request $request)
    { 
      
      $pokemonCount = PokemonLike::where('user_id', $request->user()->id)->count();
      $pokemon =  PokemonLike::where('user_id', $request->pokemon)->exists();
      if(@$pokemonCount == 3) {
         return response()->json([
            'status' => 'failed',
            'message' => 'Max reached'
         ]);
      }
      if(@$pokemon){
         return response()->json([
            'status' => 'failed',
            'message' => 'Pokemon already liked'
         ]);
      }

      $exists = PokemonHate::where('pokemon_name', $request->pokemon_name)->exists();
      if(@$exists) {
         PokemonHate::where('pokemon_name', $request->pokemon_name)->delete();
      }

      return PokemonLike::create([
      'user_id' => $request->user()->id,
      'pokemon_name' => $request->pokemon_name
      ]);
    }

    public function removeLikePokemon(Request $request)
    { 
      return PokemonLike::where('pokemon_name', $request->pokemon_name)->delete();

    }
    public function storeHatePokemon(Request $request)
    { 
      $pokemonCount = PokemonHate::where('user_id', $request->user()->id)->count();
      $pokemon =  PokemonHate::where('user_id', $request->pokemon)->exists();
      if(@$pokemonCount == 3) {
         return response()->json([
            'status' => 'failed',
            'message' => 'Max reached'
         ]);
      }
      if(@$pokemon){
         return response()->json([
            'status' => 'failed',
            'message' => 'Pokemon already liked'
         ]);
      }

      $likeExists = PokemonLike::where('pokemon_name', $request->pokemon_name)->exists();
      $favoriteExists = PokemonFavorite::where('pokemon_name', $request->pokemon_name)->exists();
      if(@$likeExists) {
         PokemonLike::where('pokemon_name', $request->pokemon_name)->delete();
      }
      if(@$favoriteExists) {
         PokemonFavorite::where('pokemon_name', $request->pokemon_name)->delete();
      }
      return PokemonHate::create([
      'user_id' => $request->user()->id,
      'pokemon_name' => $request->pokemon_name
      ]);
    }

    public function removeHatePokemon(Request $request)
    { 
      return PokemonHate::where('pokemon_name', $request->pokemon_name)->delete();

    }
}
