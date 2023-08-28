<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Throwable;


class ChangeLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // try{
        //     App()->setLocale('ar');
        //     if ($request->header('lang') !== null && $request->header('lang') == 'en')
        //         App()->setLocale('en');
        //     return $next($request);
        // }catch (Throwable $e){
        //     return response()->json([
        //         'status'=>false,
        //         'msg'=>__('messages.error'),
        //         'error-code'=>6000
        //     ]);
        // }
    }
}
