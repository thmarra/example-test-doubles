<?php


namespace App;


interface Gateway
{
    public function register(string $email): void;

    public function activate(): string;

    public function deactivate(): void;
}