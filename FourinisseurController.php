<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fournisseur;

class FournisseurController extends Controller
{
    //ajouter un fournisseur
    public function addFournisseur(Request $request)
    {
        $fournisseur = new Fournisseur();
        $fournisseur->nom = $request->nom;
        $fournisseur->prenom = $request->prenom;
        $fournisseur->email = $request->email;
        $fournisseur->password = $request->password;
        $fournisseur->numerotel = $request->numerotel;
        $fournisseur->image = $request->image;
        $fournisseur->country = $request->country;
        $fournisseur->localisation = $request->localisation;
        $fournisseur->horaire = $request->horaire;
        $fournisseur->admin_id = $request->admin_id;
        $fournisseur->save();
        return response()->json($fournisseur, 200);
    }

    //modifier un fournisseur
    public function updateFournisseur(Request $request, $id)
    {
        $fournisseur = Fournisseur::find($id);
        $fournisseur->nom = $request->nom;
        $fournisseur->prenom = $request->prenom;
        $fournisseur->email = $request->email;
        $fournisseur->password = $request->password;
        $fournisseur->numerotel = $request->numerotel;
        $fournisseur->image = $request->image;
        $fournisseur->country = $request->country;
        $fournisseur->localisation = $request->localisation;
        $fournisseur->horaire = $request->horaire;
        $fournisseur->admin_id = $request->admin_id;
        $fournisseur->save();
        return response()->json($fournisseur, 200);
    }

    //supprimer un fournisseur
    public function deleteFournisseur($id)
    {
        $fournisseur = Fournisseur::find($id);
        $fournisseur->delete();
        return response()->json($fournisseur, 200);
    }

    //afficher un fournisseur
    public function getFournisseur($id)
    {
        $fournisseur = Fournisseur::find($id);
        return response()->json($fournisseur, 200);
    }

    //afficher tous les fournisseurs
    public function getAllFournisseurs()
    {
        $fournisseurs = Fournisseur::all();
        return response()->json($fournisseurs, 200);
    }

    //afficher les fournisseurs par admin
    public function getFournisseursByAdmin($id)
    {
        $fournisseurs = Fournisseur::where('admin_id', $id)->get();
        return response()->json($fournisseurs, 200);
    }

        //login de fournisseur
        public function loginFournisseur(Request $request)
        {
            $fournisseur = Fournisseur::where('email', $request->email)->where('password', $request->password)->first();
            return response()->json($fournisseur, 200);
        }

        //logout de fournisseur
        public function logoutFournisseur(Request $request)
        {
            $fournisseur = Fournisseur::where('email', $request->email)->where('password', $request->password)->first();
            return response()->json($fournisseur, 200);
        }

        
}