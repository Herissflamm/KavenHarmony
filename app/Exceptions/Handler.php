<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use Mockery\Matcher\Closure;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException ||
            $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->view('error.404', [], 404); 
        }
        
        if ($this->isHttpException($exception) && $exception->getStatusCode() === 413) {
            return redirect()
                ->back()
                ->withErrors(['error'=> 'Le fichier téléchargé est trop volumineux. La taille maximale autorisée est de 10 Mo.']);
        }

        if ($this->isHttpException($exception) && $exception->getStatusCode() == 500) {
            return response()->view('error.500', [], 500);  
            
        }

        

        return parent::render($request, $exception);
    }
}
