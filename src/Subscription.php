<?php


namespace App;


class Subscription
{
    protected Gateway $gateway;
    protected Mailer $mailer;

    public function __construct(Gateway $gateway, Mailer $mailer)
    {
        $this->gateway = $gateway;
        $this->mailer = $mailer;
    }

    public function create(User $user): void
    {
        $this->gateway->register($user->email);

        $receipt = $this->gateway->activate();

        $user->subscribe($receipt);

        $this->mailer->send($user,'Your receipt number is: ' . $receipt);
    }
}
