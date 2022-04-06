<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCompanyId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            empty(session('company_id'))
            && (!$request->is('/') && !$request->is('lang') && !$request->is('about') && !$request->is('services') && !$request->is('contact') && !$request->is('contact-form')
                && !$request->is('company*') && !$request->is('login') && !$request->is('logout*') && !$request->is('install'))
        ) {
            return redirect('company');
        }

        if (sizeof($request->route()->parameters) == 1) {
            $paramModel = reset($request->route()->parameters);
            $companyId = $paramModel->company_id ?? '';
            if (!empty($companyId) && $companyId != session('company_id'))
                return redirect('dashboard');
        }

        return $next($request);
    }
}
