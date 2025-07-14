<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use PhpParser\Node\Stmt\TryCatch;



class AdminMiddleware
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

       try {
            $payload = JWTAuth::parseToken()->getPayload();

            $role = $payload->get('role');

            
            //1 is admin
             if ($role !== 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ban khong co quyen truy cap',
                ], 403);
            }

        } catch (Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>'Token khong hop le hoac het hang',
            ],401);
        }

        return $next($request);
    }
}
