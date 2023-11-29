<?php

/**
 * Importation des espaces de noms
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{

    public function passwordRecovery(Request $request)
    {

        $input = $request->all();
        $authmodel = new authModel;

        if ($request->has('sendOtp')) {

            $user = Utilisateur::where('USR_Contact', $input['number'])->first();

            if (!is_null($user)) {

                $checkToken = $authmodel->checkTokenByUser($user->USR_ID);

                if ($checkToken == null) {
                    // generer un nouveau token

                    $minutes_to_add = 5;

                    $time = new DateTime(date('Y-m-d H:i:s'));
                    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

                    $stamp = $time->format('Y-m-d H:i:s');

                    $token = mt_rand(100000,999999);

                    $tokenData = ['CPR_Code' => $token, 'USR_ID' => $user->USR_ID, "CPR_DateExp" => $stamp];
                    //DB::table('code_password_reset')->insert($tokenData);
                    $registerResult = $authmodel->registerToken($tokenData);

                    $text = 'Bonjour'. " \n";
                    $text1 = 'Votre code de réinitialisation est le suivant : ';
                    $text2 = ' ' . $token . ' ';
                    $text3 = 'Veuillez le saisir sur l\'application afin de reinitialise votre mot de passe.';
                    //dd($text);

                    /* if($user->USR_Email != null) {

                        $mailData = [
                            'user' => $user, 'tokenData' => $tokenData,
                            'title' => 'Récupération de mot de passe.',
                            'text' => $text,
                            'text1' => $text1,
                            'text2' => $text2,
                            'text3' => $text3,
                        ];

                        $domain = substr($user->USR_Email, strpos($user->USR_Email, '@') + 1);

                        if(filter_var($user->USR_Email, FILTER_VALIDATE_EMAIL) && checkdnsrr($domain)) {
                            Mail::to($user->USR_Email)->send(new PasswordTokenMail($mailData));
                        }
                    } */
                    
                    $msg = 'Bonjour' . " \n";
                    $msg .= "Votre code de réinitialisation est le ".$token . " \n";
                    $msg .= "LOCATYS VOUS REMERCIE.";
                
                    $callbackSms = SMS::sendSmsFromOrange($user->USR_Contact,$msg);

                    return response()->json([
                        'response' =>200,
                        'response_message' => "Code Otp envoyé.",
                        'token' => $token,
                        'success' => true
                    ], 200);

                } else {

                    $tokenData = ['CPR_Code' => $checkToken->CPR_Code, 'USR_ID' => $checkToken->USR_ID, "CPR_DateExp" => $checkToken->CPR_DateExp];

                    $text = 'Bonjour'. " \n";
                    $text1 = 'Votre code de réinitialisation est le suivant : ';
                    $text2 = ' ' . $checkToken->CPR_Code . ' ';
                    $text3 = 'Veuillez le saisir sur l\'application afin de reinitialise votre mot de passe.';
                    //dd($text);

                    if($user->USR_Email != null) {

                        $mailData = [
                        'user' => $user, 'tokenData' => $tokenData, 'title' => 'Récupération de mot de passe.',
                        'text' => $text,
                        'text1' => $text1,
                        'text2' => $text2,
                        'text3' => $text3,
                        ];

                        $domain = substr($user->USR_Email, strpos($user->USR_Email, '@') + 1);
                        
                        if(filter_var($user->USR_Email, FILTER_VALIDATE_EMAIL) && checkdnsrr($domain)) {
                            Mail::to($user->USR_Email)->send(new PasswordTokenMail($mailData));
                        }
                    }

                    $msg = 'Bonjour'. " \n";
                    $msg .= "Votre code de réinitialisation est le ".$checkToken->CPR_Code." \n";
                    $msg .= " VOUS REMERCIE.";
                
                    $callbackSms = SMS::sendSmsFromOrange($user->USR_Contact,$msg);

                    return response()->json([
                        'response' =>200,
                        'response_message' => "Code Otp envoyé.",
                        'token' => $checkToken->CPR_Code,
                        'success' => true
                    ], 200);
                    
                }
            }

            return response()->json([
                'response' =>200,
                'response_message' => "Ce numéro de téléphone n'est pas reconnu.",
                'phoneNumber' => $input['number'],
                'success' => false
            ], 200);

        }
        
        if ($request->has('changeCode')) {

            $user = Utilisateur::where('USR_Contact', $input['number'])->first();

            if (is_null($user)) {

                return response()->json([
                    'response' =>200,
                    'response_message' => "Ce numéro de téléphone n'est pas reconnu.",
                    'phoneNumber' => $input['number'],
                    'success' => false
                ],200);
                
            }
            
            $user->USR_PinCodeHash = Hash::make($input['newPin']);
            $user->USR_PinCode = $input['newPin'];
            $saved = $user->save();

            if ($saved) {

                $request->session()->flash('success','Votre mot de passe a été réinitialisé connectez vous maintenant.'); 
                return response()->json([
                    'response' =>200,
                    'response_message' => "'Votre mot de passe a été réinitialisé connectez vous maintenant",
                    'phoneNumber' => $input['number'],
                    'success' => true
                ],200);
                
            }

            $request->session()->flash('error','Une erreur s\'est produite. Veuillez recommencer l\'opération.'); 
            return response()->json([
                'response' =>200,
                'response_message' => "Une erreur s\'est produite. Veuillez recommencer l\'opérationu.",
                'phoneNumber' => $input['number'],
                'success' => false
            ],200);
            
        }

        return view('backoffice.auth.recover_password', []);
    }

    /**
     * handle user login
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn(Request $request)
    {

        $method = $request->method();
        $input = $request->all();
        $authmodel = new Auth;

        if ($method == 'POST') {

            if ($request->has('signIn')) {

                $validator = Validator::make($input, [
                    'password' => 'required',
                    'login' => 'required',
                ]);

                if ($validator->fails()) {

                    return redirect()->route('signIn')->withErrors($validator)->withInput();

                } else {

                    try {
                        
                        $user = $authmodel->signIn($input['login'], $input['password']);

                        if (is_null($user)) {

                            return redirect()->route('signIn')->with('error', 'Identifiant ou mot de passe incorrect.')->withInput();
                       
                        }

                        $sessarray = ['loggedin' => true, 'userdata' => $user, 'sessionRole' => $user->ROLE_Libelle];
                        session($sessarray);

                        return redirect()->route('index');

                        return ($this->handleSignIn($request,$user));

                    } catch (Throwable $e) {

                        dd($e);

                        return redirect()->route('signIn')->with('error', 'Une erreur s\'est produite durant l\'operation')->withInput();

                    }
                }
            }

        }

        return view('auth.sign-in', ['title' => 'Authentification']);

    }
    
    /**
     * handle user account creation
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signUp(Request $request)
    {

        $method = $request->method();
        $input = $request->all();

        if ($method == 'POST') {

            if ($request->has('signUp')) {

                $validator = Validator::make($input, [
                    'nom' => 'required',
                    'prenom' => 'required',
                    'email' => 'required|unique:users,USR_Email',
                    'password' => [
                        'required',
                        'min:8',
                        //'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                        //'confirmed'
                    ],
                ],[
                    'email.unique' => 'Un utilisateur avec cette adresse e-mail existe déjà.',
                    'password' => 'Le mot de passe doit avoir au moins 8 caractères.'
                ]);

                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();

                } else {

                    try {
                        
                        $user = new User();
                        $user->USR_Nom = $input['nom'];
                        $user->USR_Prenom = $input['prenom'];
                        $user->USR_Email = $input['email'];
                        $user->USR_Password = Hash::make($input['password']);
                        $user->ROLE_ID = Role::$userRoleId;
                        $result = $user->save();

                        if ($result) {

                            return redirect()->route('signIn')->with('success', 'Votre compte a été créée, vous pouvez maintenant vous connecter.')->withInput();
                       
                        }

                        return redirect()->back()->with('error', 'Echec de création du compte, veuillez reéssayer.')->withInput();

                    } catch (Throwable $e) {

                        return redirect()->back()->with('error', 'Une erreur s\'est produite durant l\'operation, veuillez reéssayer.')->withInput();

                    }
                }
            }

        }

        return view('auth.sign-up', ['title' => 'Créer votre compte']);

    }


    /**
     * logout user
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('signIn');
    }

}
