<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
 
{
    public function login(Request $request)
    {
        $credentials = $request->only('EmailAdmin', 'PasswordAdmin');
        $admin = Admin::where('EmailAdmin', $credentials['EmailAdmin'])->first();
    
        if (!$admin || !Hash::check($credentials['PasswordAdmin'], $admin->PasswordAdmin)) {
            return response()->json(['message' => 'Invalid!!!!'], 401);
        }
    
        $token = $admin->createToken('utilisateur-token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }
    public function logout(Request $request)
    {
        if (Auth::guard('utilisateur')->check()) {
            Auth::guard('utilisateur')->user()->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully'], 200);
        } else {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    }
    public function CreateAdmin(Request $request){
       
            $admin = new Admin();
            $admin->NomAdmin = $request->NomAdmin;
            $admin->AdresseAdmin = $request->AdresseAdmin;
            $admin->NumeroAdmin = $request->NumeroAdmin;
            $admin->EmailAdmin = $request->EmailAdmin;
            $hashedPassword = bcrypt($request->PasswordAdmin);
            $admin->PasswordAdmin = $hashedPassword;
           
            $admin->save();
            return response()->json($admin, 200);  
    }

    public function GetAllAdmins(){
        $admins = Admin::all();
        return response()->json($admins, 200);

    }
     public function UpdateAdmin(Request $request ,$id){
       
            $admin = Admin::find($id);

            $admin->NomAdmin = $request->NomAdmin;
            $admin->AdresseAdmin = $request->AdresseAdmin;
            $admin->NumeroAdmin = $request->NumeroAdmin;
            $admin->EmailAdmin = $request->EmailAdmin;
            $admin->PasswordAdmin = $request->PasswordAdmin;
           
            $admin->save();
            return response()->json($admin, 200);  
    }

     
     public function DeleteAdmin($id)
     {
         $admin = Admin::find($id);
         $admin->delete();
         return response()->json($admin, 200);
     }



}
