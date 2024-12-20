<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Psy\debug;

class AuthMid
{
    public function handle(Request $request, Closure $next)
    {
        
        
        // dd(session()->all());
        $guards = [
            'farmer' => [
                'model' => \App\Models\Farmer::class,
                'dashboard' => 'farmer.index',
            ],
            'business' => [
                'model' => \App\Models\Business::class,
                'dashboard' => 'business.dashboard',
            ],
            'agent' => [
                'model' => \App\Models\Agent::class,
                'dashboard' => 'agent.dashboard',
            ],
        ];

        foreach ($guards as $guard => $details) {
            if (Auth::guard($guard)->check()) {
                
                $currentRoute = $request->route() ? $request->route()->getName() : null;
                app('auth')->setDefaultDriver($guard);

                // Check if the user is already on their corresponding dashboard route
                // if ($currentRoute === $details['dashboard']) {
                //     // If the user is on their dashboard route, allow them to proceed
                //     return $next($request);
                // }
        

              
                // Redirect the user to their corresponding dashboard route
                // return redirect()->route($details['dashboard']);
                return $next($request);
            }
        }

        
        

        // Login flow for unauthenticated users
        $credentials = $request->only(['identifier', 'password']);
        if (empty($credentials['identifier']) || empty($credentials['password'])) {
            return redirect()->route('home.login')->withErrors(['message' => 'Identifier and Password are required.']);
        }
        $identifier = $credentials['identifier'];
        $password = $credentials['password'];
        $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL);

        foreach ($guards as $guard => $details) {
         
            $model = $details['model'];
            $user = $model::where(function ($query) use ($isEmail, $identifier) {
                $isEmail
                    ? $query->where('email', $identifier)
                    : $query->where('mobile_number', $identifier);
            })->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::guard($guard)->login($user);
                
                // Regenerate session for security
                session()->regenerate();

                // Redirect to the respective dashboard
                return redirect()->route($details['dashboard']);
            }
        }

        return redirect()->route('home.login')->withErrors(['message' => 'Invalid credentials.']);
    }

}

