<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    private array $whitelistedDomains = [
        'lacoxconsulting.com',
        'tntsecuritysolutions.com',
        'badgehirecs.com',
    ];

    public function viewLogin() : View {
        return view('auth.login');
    }

    public function tryLogin(Request $request) : RedirectResponse {
        $validated = $request->validate([
            'email' => 'email|required|string',
            'password' => 'required|string',
        ]);

        dd('LOGIN POST ROUTE', $request->all());
    }

    public function viewRegister() : View {
        return view('auth.register');
    }

    public function tryRegister(Request $request) : RedirectResponse {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        // check that the provided email address is in the list of allowed domains
        if (!in_array( explode('@', $validated['email'])[1], $this->whitelistedDomains)) {
            return back()->withErrors([
                'email' => 'The provided email address is not part of the allowed domains.',
            ]);
        }

        // check that the user doesn't already have an account
        if (DB::table('users')->where('email', $validated['email'])->exists()) {
            return back()->withErrors([
                'email' => 'This account already exists.',
            ]);
        }

        // create the new user
        $newUser = MyUser::forRegistration($validated['name'], $validated['email'], $validated['password'], false);

        // save the user
        $newUser->register();

        return redirect('home')
            ->with('registered-user', $newUser);
    }
}
