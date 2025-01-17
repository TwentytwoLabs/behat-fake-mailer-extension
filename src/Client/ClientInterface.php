<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Client;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\SpecificationInterface;

interface ClientInterface
{
    public function purgeMessages(): void;
    /**
     * @param SpecificationInterface[] $specifications
     *
     * @return Mail[]
     */
    public function findMessages(array $specifications): array;
}
