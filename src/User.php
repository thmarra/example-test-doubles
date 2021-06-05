<?php


namespace App;


class User
{
    public string $email;
    public ?string $subscription;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->subscription = null;
    }

    public function subscribe(string $subscriptionId): void
    {
        $this->subscription = $subscriptionId;
    }

    public function isSubscribed(): bool
    {
        return is_string($this->subscription);
    }
}