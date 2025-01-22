<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Specification;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\SubjectSpecification;
use PHPUnit\Framework\TestCase;

final class SubjectSpecificationTest extends TestCase
{
    public function testShouldValidateSpecification(): void
    {
        $mail1 = (new Mail())->setSubject('Contact');
        $mail2 = (new Mail())->setSubject('Lorem Ipsum');

        $specification = new SubjectSpecification('Contact');
        $this->assertSame('Contact', (string) $specification);

        $this->assertTrue($specification->isSatisfiedBy($mail1));
        $this->assertFalse($specification->isSatisfiedBy($mail2));
    }
}
