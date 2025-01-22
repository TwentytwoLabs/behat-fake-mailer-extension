<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Model;

use PHPUnit\Framework\Attributes\DataProvider;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    #[DataProvider('getData')]
    public function testShouldCreateContact(?string $name, string $data): void
    {
        $contact = Contact::fromString($data);
        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertSame('john.doe@example.com', $contact->getEmailAddress());
        $this->assertSame($name, $contact->getName());

        $this->assertTrue($contact->equals(new Contact('john.doe@example.com', $name)));
        $this->assertFalse($contact->equals(new Contact('jane.doe@example.com', $name)));
        $this->assertFalse($contact->equals(new Contact('john.doe@example.com', 'Jane Doe')));
        $this->assertFalse($contact->equals(new Contact('jane.doe@example.com', 'Jane Doe')));
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function getData(): array
    {
        return [
            [null, 'john.doe@example.com'],
            [null, '  john.doe@example.com  '],
            ['John Doe', 'John Doe <john.doe@example.com>'],
            ['John Doe', '    John Doe <john.doe@example.com>   '],
            ['John Doe', 'John Doe         <john.doe@example.com>'],
        ];
    }
}
