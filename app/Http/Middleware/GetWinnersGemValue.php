<?php

namespace App\Http\Middleware;

use App\Models\WinnersGemValue;
use Closure;
use Illuminate\Http\Request;

class GetWinnersGemValue
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $winnersGemValue = WinnersGemValue::latest()
            ->first();

        session(['winnersGemValue' => $winnersGemValue['percentage']]);

        return $next($request);
    }
}
