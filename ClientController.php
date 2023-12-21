<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    //Ajouetr un client
    public function addClient(Request $request)
    {
        $client = new Client();
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->email = $request->email;
        $client->password = $request->password;
        $client->numerotel = $request->numerotel;
        $client->image = $request->image;
        $client->country = $request->country;
        $client->localisation = $request->localisation;
        $client->horaire = $request->horaire;
        $client->admin_id = $request->admin_id;
        $client->save();
        return response()->json($client, 200);
    }

    //Modifier un client
    public function updateClient(Request $request, $id)
    {
        $client = Client::find($id);
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->email = $request->email;
        $client->password = $request->password;
        $client->numerotel = $request->numerotel;
        $client->image = $request->image;
        $client->country = $request->country;
        $client->localisation = $request->localisation;
        $client->horaire = $request->horaire;
        $client->admin_id = $request->admin_id;
        $client->save();
        return response()->json($client, 200);
    }

    //Supprimer un client
    public function deleteClient($id)
    {
        $client = Client::find($id);
        $client->delete();
        return response()->json($client, 200);
    }

    //Afficher un client
    public function getClient($id)
    {
        $client = Client::find($id);
        return response()->json($client, 200);
    }

    //Afficher tous les clients
    public function getClients()
    {
        $clients = Client::all();
        return response()->json($clients, 200);
    }

    //Afficher les clients par admin
    public function getClientByAdmin($adminId)
    {
        $clients = Client::where('admin_id', $adminId)->get();
        return response()->json($clients, 200);
    }
    public function getNomAdminDuClient($id)
    {
        // Trouver le client par son ID
        $client = Client::find($id);

        if (!$client) {
            // Gérer le cas où le client n'est pas trouvé
            return response()->json(['message' => 'Client non trouvé'], 404);
        }

        // Appeler la fonction pour obtenir le nom de l'administrateur associé
        $nomAdmin = $client->getNomAdministrateur();

        // Vous pouvez maintenant utiliser $nomAdmin comme bon vous semble
        return response()->json(['nom_admin' => $nomAdmin]);
    }

    //filtrer les clients par centre
    public function getClientByCenter($centerId)
    {
        
        $clients = Client::where('admin_id', $centerId)->get();
        return response()->json($clients, 200);
    }

    //Login de Client
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $client = Client::where('email', $credentials['email'])->first();

        if (!$client || !Hash::check($credentials['password'], $client->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $client->createToken('client-token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    //Logout de Client
    public function logout()
    {
        Auth::guard('client')->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    
}