<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        if ($user) {
            $userRole = strtolower($user->role);
            $lowercasedRoles = array_map('strtolower', $roles);
            if (in_array($userRole, $lowercasedRoles)) {
                return $next($request);
            }
        }
        
        if (!$user) {
            return redirect()->route('login');
        }

        return redirect('/admin/dashboard');
    }
}
