<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->is_active) {
                return redirect()->route('dashboard')->with('error', 'Je account is nog niet actief.');
            }
            if ($user->is_finished) {
                return redirect()->route('survey.results')->with('error', 'Je hebt de survey al voltooid.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Je moet ingelogd zijn om de survey te zien.');
        }

        return $next($request);
    }
}
