<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTypeADM
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna adalah pegawai (role = 1)
        if (Auth::check()) {

            if (in_array(Auth::user()->type, ["Administrator","FC&SM&AD"])){
                return $next($request);
            }
            return response()->view('errors.custom', ['message' => 'Youre not should be in this section'], 403);
        }
        return redirect('/'); // Ganti dengan kode status atau rute yang sesuai
        // $data = User::where('type', Auth::user()->type)->get();
        // dd($data);
    }
}
