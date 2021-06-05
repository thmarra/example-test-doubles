<?php

namespace Tests;

use App\Gateway;

class GatewayFake implements Gateway
{
    public function register(string $email): void
    {
        // chamada do servico externo
    }

    public function activate(): string
    {
        return 'some-uuid';
    }

    public function deactivate(): void
    {
        // chamada servico externo
    }
}