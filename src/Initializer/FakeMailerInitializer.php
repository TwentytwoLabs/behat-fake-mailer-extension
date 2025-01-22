<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use TwentytwoLabs\BehatFakeMailerExtension\Client\ClientInterface;
use TwentytwoLabs\BehatFakeMailerExtension\Context\FakeMailerContext;

final class FakeMailerInitializer implements ContextInitializer
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function initializeContext(Context $context): void
    {
        if ($context instanceof FakeMailerContext) {
            $context
                ->setClient($this->client)
            ;
        }
    }
}
