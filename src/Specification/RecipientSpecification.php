<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;

final class RecipientSpecification implements SpecificationInterface
{
    private Contact $recipient;

    public function __construct(Contact $recipient)
    {
        $this->recipient = $recipient;
    }

    public function __toString(): string
    {
        return $this->recipient->getEmailAddress();
    }

    public function isSatisfiedBy(Mail $mail): bool
    {
        $recipients = $mail->getRecipients();
        foreach ($recipients as $recipient) {
            if ($recipient->equals($this->recipient)) {
                return true;
            }
        }

        return false;
    }
}
