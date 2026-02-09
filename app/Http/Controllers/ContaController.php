<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\Conta;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ResetPassword;
use \Illuminate\Notifications\Notifiable;
use Notification;
use App\Notifications\SolicitacaoAcesso_recusada;
use Auth;
class ContaController extends Controller
{


    public function __construct()
    {

    }
    private function sendResetEmail($email, $token)
    {
       //Retrieve the user from the database
       $user = User::where('email',$email)->first();
       //Generate, the password reset link. The token generated is embedded in the link

       try {

         Notification::send($user,new ResetPassword($user,$token));
         return true;
       } catch (\Exception $e) {
         return false;
       }
    }
    public function validatePasswordRequest(Request $request)
    {   $usersAdmin=User::where( 'user_type', 'admin')->get();
	$user= $usersAdmin->where('email',$request['email'])->first();

        //Check if the user exists
        if ($user==null) {
            return redirect()->back()->withErrors(['email' => trans('Conta do usuário não existe')]);
        }
         //Create Password Reset Token
        DB::table('password_resets')->insert([
                 'email' => $request->email,
                 'token' => str_random(60),
                 'created_at' => Carbon::now()
                 ]);
       //Get the token just created above
        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();
        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('status', trans('Um link de redefinição de senha foi enviado para seu email'));
        }
       return redirect()->back()->withErrors(['error' => trans('Ocorreu um erro de rede. Por favor, tente novamente.')]);


    }

    public function resetPassword(Request $request)
   {
        //Validate input
        $validator = Validator::make($request->all(), [
        'email' => 'required|exists:users,email',
        'password' => 'required|string|min:6|confirmed'
       ]);

       //check if input is valid before moving on
       if ($validator->fails()) {
          return redirect()->back()->withErrors($validator);
       }


       // Validate the token
       $tokenData = DB::table('password_resets')->where('token', $request->token)->first();
       // Redirect the user back to the password reset request form if the token is invalid
       if (!$tokenData) return redirect()->back()->with('success','Link expirado!');

       $user = User::where('email', $tokenData->email)->first();
       // Redirect the user back if the email is invalid
       if (!$user) return redirect()->back()->withErrors(['email' => 'Email não encontrado']);
       //Hash and update the new password
       $conta=Conta::where('user_id',$user->id)->first();
       $conta->password =Hash::make($request->password);
       $conta->update();

       //login the user immediately they change password successfully
       Auth::login($user);

       //Delete the token
       DB::table('password_resets')->where('email', $user->email)->delete();

      return redirect()->route('auth.gerenciar')->with('success','Senha alterada com sucesso');


   }

}
