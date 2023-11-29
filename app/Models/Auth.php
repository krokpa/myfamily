<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class Auth extends Model
{

    public function signIn($Identifiant,$password){

        $utilisateur = DB::table('users')
                        ->join('roles', 'roles.ROLE_ID','=','users.ROLE_ID')
                        ->where('users.USR_Email', $Identifiant)->first();
        
        if($utilisateur != null){

            $checkpassword = Hash::check($password, $utilisateur->USR_Password);

            if($checkpassword){
                return $utilisateur;
            }
            return null;
            
        }

    }

}
