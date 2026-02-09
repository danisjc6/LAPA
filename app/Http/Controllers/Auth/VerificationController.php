<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use App\Notifications\SolicitacaoVisita;
use App\Models\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        $this->middleware('auth')->except('verificarVisita', 'confirmacaoEmail');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verificarVisita(Request $request)
    {
        $user = $this->user->find($request->route('id'));

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->markEmailAsVerified())
            event(new Verified($user));

        $admins = $this->user
            ->whereNotNull('cpf_verified_at')
            ->where('user_type', 'admin')
            ->get();
        foreach ($admins as $admin) {
                $admin->notify(new SolicitacaoVisita($admin));
        }

        return redirect()->route('confirmacao.email')->with('success', 'E-mail verificado com sucesso! Agora é só aguardar a confirmação da sua visita por e-mail.');
    }

    public function confirmacaoEmail()
    {
        return view('vendor.mail.confirmation');
    }
}
