<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Session;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 401) {
                Session::flush();
                return redirect()->to('/auth-login')->with([ 'error' => 'token is expired please login first' ]);
            }

            if ($exception->getStatusCode() == 333) {
                return redirect()->back()->with([ 'error' => $exception->getMessage() ]);
            }
    
            // if ($exception->getStatusCode() == 500) {
            //     print_r($exception->getMessage());
            //     return $exception->getMessage();
            //     return response()->view('errors.' . '500');
            // }
        }

        return parent::render($request, $exception);
    }
}
