<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    private const EMAIL_MAX_ATTEMPTS = 5;    // wrong tries per email + device
    private const IP_MAX_ATTEMPTS    = 20;   // wrong tries per device, any email
    private const LOCK_SECONDS       = 300;  // 5 minutes

    public function show()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validateWithBag('login', [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $emailKey = Str::transliterate(Str::lower($credentials['email']) . '|' . $request->ip());
        $ipKey    = 'login-ip|' . $request->ip();
        $limits   = [$emailKey => self::EMAIL_MAX_ATTEMPTS, $ipKey => self::IP_MAX_ATTEMPTS];

        // already locked? refuse, even if the password is correct
        if ($seconds = $this->lockedSeconds($limits)) {
            return $this->lockedResponse($request, $seconds);
        }

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            foreach (array_keys($limits) as $key) {
                RateLimiter::hit($key, self::LOCK_SECONDS);
            }

            if ($seconds = $this->lockedSeconds($limits)) {
                return $this->lockedResponse($request, $seconds);
            }

            $left = RateLimiter::remaining($emailKey, self::EMAIL_MAX_ATTEMPTS);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => "Wrong email or password. {$left} attempt(s) left."], 'login');
        }

        RateLimiter::clear($emailKey);
        $request->session()->regenerate();

        return redirect()->intended(route('students.index'));
    }

    public function register(Request $request)
    {
        $data = $request->validateWithBag('register', [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $user = User::create($data);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('students.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function lockedSeconds(array $limits): int
    {
        $wait = 0;
        foreach ($limits as $key => $max) {
            if (RateLimiter::tooManyAttempts($key, $max)) {
                $wait = max($wait, RateLimiter::availableIn($key));
            }
        }
        return $wait;
    }

    private function lockedResponse(Request $request, int $seconds)
    {
        return back()
            ->withInput($request->only('email'))
            ->with('lockout', $seconds)
            ->withErrors(['email' => 'Too many failed attempts. Login is locked for now.'], 'login');
    }
}