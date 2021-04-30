<?php

namespace App\Mercure;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Symfony\Component\Mercure\Jwt\TokenProviderInterface;

final class JwtProvider implements TokenProviderInterface
{
    private $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function getJwt(): string
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText($this->secret)
        );

        $token = $config->builder()
            // ->expiresAt((new \DateTimeImmutable())->modify('+1 hour'))
            ->withClaim(
                'mercure',
                [
                    'publish' => [
                        "*"
                    ]
                ]
            )
            ->getToken($config->signer(), $config->signingKey());

        return $token->toString();
        // return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOlsiKiJdfX0.v5RABMcrQgTfk1Z97oUjEU4HYR9CLTRYNMTJed8ntZI';
    }
}
