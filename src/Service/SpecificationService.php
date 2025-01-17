<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Service;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\BodySpecification;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\RecipientSpecification;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\SenderSpecification;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\SpecificationInterface;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\SubjectSpecification;

final class SpecificationService
{
    /**
     * @return SpecificationInterface[]
     */
    public static function get(
        ?string $from,
        ?string $recipient,
        ?string $subject,
        ?string $body
    ): array {
        $specifications = [];

        if (!empty($from)) {
            $specifications['sender'] = new SenderSpecification(Contact::fromString($from));
        }

        if (!empty($recipient)) {
            $specifications['recipient'] = new RecipientSpecification(Contact::fromString($recipient));
        }

        if (!empty($subject)) {
            $specifications['subject'] = new SubjectSpecification($subject);
        }

        if (!empty($body)) {
            $specifications['body'] = new BodySpecification($body);
        }

        return $specifications;
    }
}
