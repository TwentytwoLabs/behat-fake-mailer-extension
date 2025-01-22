<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Initializer;

use TwentytwoLabs\BehatFakeMailerExtension\Client\ClientInterface;
use TwentytwoLabs\BehatFakeMailerExtension\Context\FakeMailerContext;
use TwentytwoLabs\BehatFakeMailerExtension\Initializer\FakeMailerInitializer;
use PHPUnit\Framework\TestCase;

final class FakeMailerInitializerTest extends TestCase
{
    public function testShouldInitializeContext(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $context = new FakeMailerContext();

        $initializer = new FakeMailerInitializer($client);
        $initializer->initializeContext($context);

        $this->assertSame($client, $context->getClient());
    }
}
