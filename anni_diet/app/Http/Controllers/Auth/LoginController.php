<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        credentials as authUsersCredentials;
        attemptLogin as authUserAttemptLogin;
        validateLogin as authUserValidateLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {

        if ($request->wantsJson()) {
            $request->validate([
                'password' => 'required|string',
            ]);
        } else {
            $this->authUserValidateLogin($request);
        }
    }

    protected function credentials(Request $request)
    {
        if ($request->wantsJson()) {
            return $request->only('password');
        } else {
            return $this->authUsersCredentials($request);
        }
    }

    protected function attemptLogin(Request $request)
    {
        if ($request->wantsJson()) {
            $password = $this->credentials($request)['password'];
            return $this->doesUserWithPasswordExists($password);
        } else {
            return $this->authUserAttemptLogin($request);
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, User $user)
    {
        // Login from unity
        if ($request->wantsJson()) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('anni_diet')->accessToken,
            ]);
        } else // Login from website
        {
            redirect()->action('HomeController@index')
                ->with([
                    'user' => $user,
                    'token' => $user->createToken('anni_diet')->accessToken,
                ]);
        }

    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse
     */
    protected function sendLoginResponse(Request $request)
    {

        if (!$request->wantsJson()) {
            $request->session()->regenerate();
            $user = $this->guard()->user();
        } else {
            $user = $this->userWithThisPassword($request->get('password'));
        }

        $this->clearLoginAttempts($request);


        if ($response = $this->authenticated($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->intended($this->redirectPath());
    }

    private function doesUserWithPasswordExists($password)
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Hash::check($password, $user->password)) {
                return true;
            }
        }
        return false;
    }

    private function userWithThisPassword($password)
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Hash::check($password, $user->password)) {
                return $user;
            }
        }
        return null;
    }
}
