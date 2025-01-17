<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;

final class SubjectSpecification implements SpecificationInterface
{
    private string $subject;

    public function __construct(string $subject)
    {
        $this->subject = $subject;
    }

    public function __toString(): string
    {
        return $this->subject;
    }

    public function isSatisfiedBy(Mail $mail): bool
    {
        return $mail->getSubject() === $this->subject;
    }
}
