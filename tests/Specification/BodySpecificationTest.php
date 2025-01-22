<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\BodySpecification;
use PHPUnit\Framework\TestCase;

final class BodySpecificationTest extends TestCase
{
    public function testShouldValidateSpecification(): void
    {
        $mail1 = (new Mail())->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictu.');
        $mail2 = (new Mail())->setBody('arcu');

        $specification = new BodySpecification('Donec');
        $this->assertSame('Donec', (string) $specification);
        $this->assertTrue($specification->isSatisfiedBy($mail1));
        $this->assertFalse($specification->isSatisfiedBy($mail2));
    }
}
