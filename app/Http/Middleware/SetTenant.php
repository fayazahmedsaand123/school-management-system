<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;


class SetTenant
{
    public function handle(Request $request, Closure $next)
    {
        // If tenant_id not in session, set first tenant as default
        if (!session()->has('tenant_id')) {
            $tenant = Tenant::first();

            if ($tenant) {
                session(['tenant_id' => $tenant->id]);
            }
        }


        return $next($request);
    }
}