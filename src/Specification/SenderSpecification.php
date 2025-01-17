<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;

final class SenderSpecification implements SpecificationInterface
{
    private Contact $sender;

    public function __construct(Contact $sender)
    {
        $this->sender = $sender;
    }

    public function __toString(): string
    {
        return $this->sender->getEmailAddress();
    }

    public function isSatisfiedBy(Mail $mail): bool
    {
        $sender = $mail->getSender();

        return $sender->equals($this->sender);
    }
}
