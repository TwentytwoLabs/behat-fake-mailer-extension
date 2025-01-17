<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use TwentytwoLabs\BehatFakeMailerExtension\Client\ClientInterface;
use TwentytwoLabs\BehatFakeMailerExtension\Context\FakeMailerContext;

final class FakeMailerInitializer implements ContextInitializer
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public function initializeContext(Context $context): void
    {
        if ($context instanceof FakeMailerContext) {
            $context
                ->setClient($this->httpClient)
            ;
        }
    }
}
