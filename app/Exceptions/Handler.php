<?php

namespace App\Exceptions;

use App\Mail\ExceptionOccured;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if(config('app.env') == 'production') {
            $this->sendEmail($exception);
        }

        return parent::render($request, $exception);
    }

    public function sendEmail(Throwable $exception)
    {
        try {
            $content['message'] = $exception->getMessage();
            $content['file'] = $exception->getFile();
            $content['line'] = $exception->getLine();
            $content['trace'] = $exception->getTrace();

            if ($exception instanceof HttpException) {
                $content['code'] = $exception->getStatusCode();
                $content['headers'] = $exception->getHeaders();
            } else {
                $content['code'] = 500;
                $content['headers'] = [];
            }

            $content['url'] = request()->url();
            $content['body'] = request()->all();
            $content['ip'] = request()->ip();

            $excludedLinkSubstrings = [
                'wlwmanifest.xml',
                '.env',
                'sitemap',
                'config',
                '.yml',
                'credentials',
                'phpinfo',
            ];

            $excludedBodySubstrings = [
                'androxgh0st',
            ];

            $send = true;

            foreach($excludedLinkSubstrings as $excludedLinkSubstring) {
                if(str_contains($content['url'], $excludedLinkSubstring)) {
                    $send = false;
                    break;
                }
            }

            foreach($excludedBodySubstrings as $excludedBodySubstring) {
                if(str_contains(json_encode($content['body']), $excludedBodySubstring)) {
                    $send = false;
                    break;
                }
            }

            if($send) {
                if(str_contains($content['url'], '8fairwin8tradingcorp.com')) {
//                    if($content['code'] != '404') {
                        Mail::to('bernardhistorillo1@gmail.com')->send(new ExceptionOccured($content));
//                    }
                }
            }
        } catch (Throwable $exception) {
            Log::error($exception);
        }
    }
}
