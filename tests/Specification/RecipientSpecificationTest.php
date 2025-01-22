<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\RecipientSpecification;
use PHPUnit\Framework\TestCase;

final class RecipientSpecificationTest extends TestCase
{
    public function testShouldValidateSpecification(): void
    {
        $mail1 = (new Mail())->setRecipients([
            Contact::fromString('jane@example.com'),
            Contact::fromString('John Doe <john@example.com>'),
        ]);

        $mail2 = (new Mail())->setRecipients([Contact::fromString('jane@example.com')]);

        $specification = new RecipientSpecification(Contact::fromString('John Doe <john@example.com>'));
        $this->assertSame('john@example.com', (string) $specification);

        $this->assertTrue($specification->isSatisfiedBy($mail1));
        $this->assertFalse($specification->isSatisfiedBy($mail2));
    }
}
