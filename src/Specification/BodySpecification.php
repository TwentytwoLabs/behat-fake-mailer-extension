<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;

final class BodySpecification implements SpecificationInterface
{
    private string $snippet;

    public function __construct(string $snippet)
    {
        $this->snippet = $snippet;
    }

    public function __toString(): string
    {
        return $this->snippet;
    }

    public function isSatisfiedBy(Mail $mail): bool
    {
        return str_contains($mail->getBody(), $this->snippet);
    }
}
