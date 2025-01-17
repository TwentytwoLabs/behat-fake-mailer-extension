<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;

interface SpecificationInterface
{
    public function __toString(): string;
    public function isSatisfiedBy(Mail $mail): bool;
}
