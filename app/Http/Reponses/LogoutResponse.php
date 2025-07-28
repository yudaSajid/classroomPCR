<?php

namespace App\Http\Reponses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LogoutResponse implements Responsable
{
    public function toResponse($request): RedirectResponse
    {
        // Clear all session data
        Session::flush();

        // Clear cache by adding cache control headers
        return redirect('/')
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }
}
