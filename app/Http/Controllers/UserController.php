<?php

namespace App\Http\Controllers;

use App\Mail\Added;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:255'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_token' => Str::random(60),

        ]);

        $this->emailurl($user);

        return redirect()->back();
    }

    protected function emailurl(User $user)
    {
        $url = route('verification.verify', ['token' => $user->verification_token, 'email' => $user->email]);
        Mail::to($user->email)->send(new Added($url));
    }

    public function verify($token, $email)
    {
        $user = User::where('verification_token', $token)
            ->where('email', $email)
            ->first();

        if (!$user) {
            return abort(403);
        }

        $user->update([
            'verification_token' => null,
            'email_verified_at' => now(),
        ]);

        return redirect('admin');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('message', 'Invalid credentials');
        }

        Auth::attempt($credentials);

        if (1 === $user->admin) {
            return redirect()->route('admin');
        } else {

            return redirect()->route('profile');

        }

    }

    public function notice()
    {
        return view('verification.notice');
    }

}
