<?php

namespace App\Http\Middleware;

use App\Access\Navigation;
use App\Cms\Catalog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAccess
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();
        if ($permission === 'page' && ! isset(Catalog::pages()[$request->route('page')])) {
            abort(404);
        }

        $key = $permission === 'page'
            ? 'page.'.$request->route('page')
            : $permission;

        if ($user?->allows($key)) {
            return $next($request);
        }

        if ($permission === 'overview') {
            $fallback = Navigation::firstUrl($user);

            if ($fallback && $fallback !== route('admin.home')) {
                return redirect()->to($fallback);
            }
        }

        return response()->view('admin.denied', [], 403);
    }
}
