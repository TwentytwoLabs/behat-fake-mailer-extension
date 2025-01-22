<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\SenderSpecification;
use PHPUnit\Framework\TestCase;

final class SenderSpecificationTest extends TestCase
{
    public function testShouldValidateSpecification(): void
    {
        $mail1 = (new Mail())->setSender(Contact::fromString('John Doe <john@example.com>'));
        $mail2 = (new Mail())->setSender(Contact::fromString('jane@example.com'));

        $specification = new SenderSpecification(Contact::fromString('John Doe <john@example.com>'));
        $this->assertSame('john@example.com', (string) $specification);

        $this->assertTrue($specification->isSatisfiedBy($mail1));
        $this->assertFalse($specification->isSatisfiedBy($mail2));
    }
}
