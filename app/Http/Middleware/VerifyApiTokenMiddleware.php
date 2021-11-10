<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Repository\TokenRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $secret_string = $this->bearerToken($request);
        $token = TokenRepository::fetchTokenBySecretStringWithAdmin($secret_string);

        if (!$token) {
            return response()->json(
                [
                    'message' => __('messages.errors.needs_login')
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $request = $request->merge([
            'secret_string' => $secret_string,
            'admin' => $token->admin
        ]);

        return $next($request);
    }

    /**
     * Get the bearer token from the request headers.
     *
     * @param Request $request
     * @return string|null
     */
    public function bearerToken(Request $request): ?string
    {
        $header = $request->header('Authorization', '');

        if (!Str::startsWith($header, 'Bearer ')) {
            return null;
        }

        return Str::substr($header, 7);
    }
}
