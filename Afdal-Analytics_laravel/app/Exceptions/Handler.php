<?php

namespace App\Exceptions;

use App\Models\Seo;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Lang;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });
    }

    public function render($request, Throwable $exception)
    {
        // dd($request->cookie('locale'));
//         dd(Crypt::decrypt(Cookie::get('locale'), false));
//         $encrypter = app(\Illuminate\Contracts\Encryption\Encrypter::class);

// // decrypt
// $decryptedString = $encrypter->decrypt(Cookie::get('locale'));
//         dd($decryptedString);
//         if(request()->hasCookie('locale')) {
//             // Get cookie
//             $cookie = request()->cookie('locale');
//             // Check if cookie is already decrypted if not decrypt
//             $cookie = strlen($cookie) > 2 ? decrypt($cookie) : $cookie;
//             // Set locale
//             app()->setLocale($cookie);
//         }
        // if($request->hasCookie('locale')) {
        //     $exploded=explode("|",Crypt::decrypt(Cookie::get('locale'), false));
        //     app()->setLocale($exploded['1']);
        // }
        if ($this->isHttpException($exception)) {
            if($request->hasCookie('locale')) {
                if (str_contains(Cookie::get('locale'), '|')) {
                    $exploded=explode("|",Crypt::decrypt(Cookie::get('locale'), false));
                    app()->setLocale($exploded['1']);
                }else{
                    app()->setLocale(Cookie::get('locale'));
                }
                
            }
            if (request()->is('dashboard/*')) {
                if ($exception->getStatusCode() == 404) {
                    $seo = Seo::where('route', 'Not Found')->first();
                    return response()->view('errors.' . '405', compact('seo'), 404);
                }
            } else {
                if ($exception->getStatusCode() == 404) {
                    $seo = Seo::where('route', 'Not Found')->first();
                    return response()->view('errors.' . '404', compact('seo'), 404);
                }
            }


        }

        return parent::render($request, $exception);
    }
}
