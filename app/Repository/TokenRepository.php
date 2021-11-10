<?php

namespace App\Repository;

use App\Models\Admin;
use App\Models\Token;
use Illuminate\Support\Str;

class TokenRepository
{
    /**
     * @param Admin $admin
     * @return Token
     */
    public static function store(Admin $admin): Token
    {
        $token = new Token;

        $token->secret_string = Str::random(250);
        $token->agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $token->admin_id = $admin->id;

        $token->save();

        return $token;
    }

    /**
     * @param string|null $secret_string
     * @return Token|null
     */
    public static function fetchTokenBySecretStringWithAdmin(?string $secret_string): ?Token
    {
        return Token::query()
            ->where('secret_string', $secret_string)
            ->with('admin')
            ->first();
    }

    /**
     * @param string $secret_string
     */
    public static function deleteBySecretString(string $secret_string): void
    {
        Token::query()
            ->where('secret_string', $secret_string)
            ->delete();
    }
}
