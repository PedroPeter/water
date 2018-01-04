<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $permissao = $user->cargo;
        if ($permissao == "Gerente") {
            return redirect()->route('dashboard')->with("permissao", "Nao tem permissao para aceder a essa funcionalidade! Somente o administrador pode o fazer.");
        }
        return $next($request);
    }
}
