<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\FamilyMember;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function home(Request $request)
    {
        return view('home.index', ['title' => 'Bienvenue']);
    }
   
    public function users(Request $request)
    {
        try {
           
            $USR_ID = session('userdata')->USR_ID;
            $input = $request->all();
            $uniqid = strtoupper(uniqid());
           
            $user = User::where('USR_ID',$USR_ID)->first();

            if($request->has('createUser')){

                if ($request->hasFile('photo')) {
                    $filename = 'PP_' . $uniqid.'.'.$request->photo->getClientOriginalExtension();
                    $request->photo->storeAs('public/images/users/', $filename);
                }else{
                    $filename = null;
                }

                $utilisateur = new User;
                $utilisateur->USR_Nom = $input['nom'];
                $utilisateur->USR_Prenom = $input['prenom'];
                $utilisateur->USR_Email = $input['email'] ?? null;
                $utilisateur->USR_Password = Hash::make($input['password']);
                $utilisateur->ROLE_ID = $input['role'] ?? Role::$userRoleId;

                if ($request->hasFile('photo')) {
                    $utilisateur->USR_Photo = $filename; 
                }

                $saveResult = $utilisateur->save();

                if ($saveResult) {

                    return redirect()->route('manage_users')->with('success','L\'utilisateur a été créée.')->withInput();
                }
                return redirect()->route('manage_users')->with('danger','Echec de création de l\' utilisateur.')->withInput();

            }
            
            if($request->has('updateUser')){

                if ($request->hasFile('photo')) {
                    $filename = 'PP_' . $uniqid.'.'.$request->photo->getClientOriginalExtension();
                    $request->photo->storeAs('public/images/users/', $filename);
                }else{
                    $filename = null;
                }

                $utilisateur = User::find($input['userid']);
                $utilisateur->USR_Nom = $input['USR_Nom'] ?? $utilisateur->USR_Nom;
                $utilisateur->USR_Prenom = $input['USR_Prenom'] ?? $utilisateur->USR_Prenom;
                $utilisateur->USR_Email = $input['USR_Email'] ?? $utilisateur->USR_Email;
                $utilisateur->ROLE_ID = $input['role'] ?? $user->ROLE_ID;

                if ($request->hasFile('photo')) {
                    $utilisateur->USR_Photo = $filename; 
                }

                $saveResult = $utilisateur->save();

                if ($saveResult) {

                    return redirect()->route('manage_users')->with('success','Les informations de l\'utilisateur ont été mises à jour.')->withInput();
                }
                return redirect()->route('manage_users')->with('danger','Echec de la mise à jour de l\'utilisateur.')->withInput();

            }

            if($request->has('del')){
               
                $deleteResult = User::destroy($input['userid']);
    
                if ($deleteResult) {
                    return redirect()->route('manage_users')->with('success','l\'utilisateur a été supprimée.')->withInput();
                }
                return redirect()->route('manage_users')->with('danger','Echec de la suppression de l\'utilisateur.')->withInput();
    
            }
            
            
        }catch(\Throwable $th){

            return redirect()->route('manage_users')->with('danger','Une erreur s\'est produite, veuillez reéssayer.')->withInput();
        }

        $users = User::all();
        $roles = Role::all();

        $data = [
            'users' => $users,
            'roles' => $roles,
            'userdata' => $user,
            'title' => 'Gestion des utilisateurs'
        ];

        return view('home.users', $data);
    }
    
    public function family(Request $request)
    {
        try {
           
            $USR_ID = session('userdata')->USR_ID;
            $input = $request->all();
            $uniqid = strtoupper(uniqid());
           
            $user = User::find($USR_ID);

            if($request->has('createMember')){

                $parent = new FamilyMember();
                $parent->FAM_NOM = $input['nom'];
                $parent->FAM_PRENOM = $input['prenom'];
                $parent->FAM_CONTACT  = $input['contact'];
                $parent->USR_ID = $USR_ID;
                $parent->FAM_LIEN = $input['lien'];

                $saveResult = $parent->save();

                if ($saveResult) {

                    return redirect()->route('manage_family')->with('success','Le membre a été créée.')->withInput();
                }
                return redirect()->route('manage_family')->with('danger','Echec de création du membre.')->withInput();

            }
           

        }catch(\Throwable $th){

            return redirect()->route('manage_family')->with('danger','Une erreur s\'est produite, veuillez reéssayer.')->withInput();
        }

        $members = $user->familyMembers;
        $roles = Role::all();

        $data = [
            'user' => $user,
            'members' => $members,
            'userdata' => $user,
            'title' => 'Gestion des membres familiaux'
        ];

        return view('home.family', $data);
    }
   
    public function userCars(Request $request, $id)
    {
        try {
           
            $input = $request->all();
            $uniqid = strtoupper(uniqid());
           
            $USR_ID = session('userdata')->USR_ID;
            $connected = User::where('USR_ID',$USR_ID)->first();

            $user = User::where('USR_ID',$id)->first();

            if($user == null){
                return redirect()->route('manage_users')->with('error','Utilisateur inexistant.')->withInput();
            }

            if($request->has('createCar')){

                $car = new Car;
                $car->CAR_Color = $input['couleur'];
                $car->CAR_Immat = $input['immat'];
                $car->CAR_Marque = $input['marque'];
                $car->CAR_Modele = $input['modele'];
                $car->CAR_Year = $input['annee'];
                $car->CAR_TypeMoteur = $input['typemoteur'];
                $car->USR_ID = $id;

                $saveResult = $car->save();

                if ($saveResult) {

                    return redirect()->route('manage_user_cars',['id'=>$id])->with('success','Le véhicule a été créée.')->withInput();
                }
                return redirect()->route('manage_user_cars',['id'=>$id])->with('danger','Echec de création du véhicule.')->withInput();

            }
            
            if($request->has('updateCar')){

                $car = Car::find($input['carid']);

                if($car == null){
                    return redirect()->route('manage_users')->with('error','Véhicule inexistant.')->withInput();
                }

                $car->CAR_Color = $input['couleur'] ?? $car->CAR_Color;
                $car->CAR_Immat = $input['immat'] ?? $car->CAR_Immat;
                $car->CAR_Marque = $input['marque'] ?? $car->CAR_Marque;
                $car->CAR_Modele = $input['modele'] ?? $car->CAR_Modele;
                $car->CAR_Year = $input['annee'] ?? $car->CAR_Year;
                $car->CAR_TypeMoteur = $input['typemoteur'] ?? $car->CAR_TypeMoteur;

                $saveResult = $car->save();

                if ($saveResult) {

                    return redirect()->route('manage_user_cars',['id'=>$id])->with('success','Le véhicule a été modifié.')->withInput();
                }
                return redirect()->route('manage_user_cars',['id'=>$id])->with('danger','Echec de modification du véhicule.')->withInput();

            }
            
            if($request->has('updateUser')){

                if ($request->hasFile('photo')) {
                    $filename = 'PP_' . $uniqid.'.'.$request->photo->getClientOriginalExtension();
                    $request->photo->storeAs('public/images/users/', $filename);
                }else{
                    $filename = null;
                }

                $utilisateur = User::find($input['userid']);
                $utilisateur->USR_Nom = $input['USR_Nom'] ?? $utilisateur->USR_Nom;
                $utilisateur->USR_Prenom = $input['USR_Prenom'] ?? $utilisateur->USR_Prenom;
                $utilisateur->USR_Email = $input['USR_Email'] ?? $utilisateur->USR_Email;
                $utilisateur->ROLE_ID = $input['role'] ?? $user->ROLE_ID;

                if ($request->hasFile('photo')) {
                    $utilisateur->USR_Photo = $filename; 
                }

                $saveResult = $utilisateur->save();

                if ($saveResult) {

                    return redirect()->route('manage_users')->with('success','Les informations de l\'utilisateur ont été mises à jour.')->withInput();
                }
                return redirect()->route('manage_users')->with('danger','Echec de la mise à jour de l\'utilisateur.')->withInput();

            }

            if($request->has('del')){
               
                $deleteResult = Car::destroy($input['carid']);
    
                if ($deleteResult) {
                    return redirect()->route('manage_user_cars',['id'=>$id])->with('success','le véhicule a été supprimée.')->withInput();
                }
                return redirect()->route('manage_user_cars',['id'=>$id])->with('danger','Echec de la suppression du véhicule.')->withInput();
    
            }
            
            
        }catch(\Throwable $th){

            return redirect()->route('manage_users')->with('danger','Une erreur s\'est produite, veuillez reéssayer.')->withInput();

        }

        $cars = Car::where('USR_ID',$id)->get();

        $data = [
            'cars' => $cars,
            'user' => $user,
            'userdata' => $connected,
            'title' => 'Gestion des véhicules de '.$user->USR_Nom.' '.$user->USR_Prenom 
        ];

        return view('home.user-cars', $data);
    }
    


}