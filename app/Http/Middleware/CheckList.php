<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckList
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna adalah pegawai (role = 1)
        if (Auth::check()) {
            if (in_array(Auth::user()->type, ["PList","all"])) {

            // if (Auth::user()->type == "Ship-Mark"){
                return $next($request);
            }
            return response()->view('errors.custom', ['message' => 'Youre not should be in this section'], 403);
        }
        return redirect('/');; // Ganti dengan kode status atau rute yang sesuai
    }
}
