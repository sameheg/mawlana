<?php

namespace App\Services\Auth;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    public function __construct(
        private string $secret = '',
        private string $algo = 'HS256',
        private int $ttl = 3600
    ) {
        $this->secret = config('jwt.secret');
        $this->ttl = (int) config('jwt.ttl');
    }

    public function createToken(User $user): string
    {
        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + $this->ttl,
        ];

        return JWT::encode($payload, $this->secret, $this->algo);
    }

    public function validateToken(string $token): ?User
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secret, $this->algo));
            return User::find($decoded->sub);
        } catch (\Throwable $e) {
            return null;
        }
    }
}

