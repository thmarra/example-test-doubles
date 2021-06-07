<?php

namespace Tests;

use App\Gateway;
use App\Mailer;
use App\Subscription;
use App\User;
use \Mockery;
use \PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testValidaUsuarioComAssinatura(): void
    {
        $gatewayFake = new GatewayFake();
        $mailerDummy = $this->createMock(Mailer::class);

        $subscription = new Subscription($gatewayFake, $mailerDummy);
        $user = new User('Maria');

        self::assertFalse($user->isSubscribed());

        $subscription->create($user);

        self::assertTrue($user->isSubscribed());
    }

    public function testValidaValorCorretoAssinatura(): void
    {
        $gatewayStub = $this->createStub(Gateway::class);
        $gatewayStub->method('activate')->willReturn('some-uuid');

        $mailerDummy = $this->createMock(Mailer::class);

        $subscription = new Subscription($gatewayStub, $mailerDummy);
        $user = new User('Maria');

        self::assertNull($user->subscription);

        $subscription->create($user);

        self::assertEquals('some-uuid', $user->subscription);
    }

    public function testValidaEnvioDeEmail(): void
    {
        $user = new User('Maria');

        $this->expectNotToPerformAssertions();

        $gatewayStub = $this->createStub(Gateway::class);
        $gatewayStub->method('activate')->willReturn('some-uuid');

        $mailerMock = Mockery::mock(Mailer::class);
        $mailerMock
            ->shouldReceive('send')
            ->once()
            ->withArgs([$user, 'Your receipt number is: some-uuid']);

        $subscription = new Subscription($gatewayStub, $mailerMock);
        $subscription->create($user);
    }

    public function testConfirmaAssinaturaAtiva(): void
    {
        $this->expectNotToPerformAssertions();

        $gatewaySpy = Mockery::spy(Gateway::class);
        $mailerDummy = $this->createMock(Mailer::class);

        $subscription = new Subscription($gatewaySpy, $mailerDummy);
        $subscription->create(new User('Maria'));

        $gatewaySpy->shouldHaveReceived('activate');
        $gatewaySpy->shouldNotHaveReceived('deactivate');
    }

}
