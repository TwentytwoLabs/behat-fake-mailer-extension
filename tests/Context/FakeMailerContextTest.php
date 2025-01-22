<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Context;

use TwentytwoLabs\BehatFakeMailerExtension\Client\ClientInterface;
use TwentytwoLabs\BehatFakeMailerExtension\Context\FakeMailerContext;
use PHPUnit\Framework\TestCase;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\SpecificationInterface;

final class FakeMailerContextTest extends TestCase
{
    public function testShouldPurgeMessages(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client->expects($this->once())->method('purgeMessages');

        $context = $this->getContext();
        $context->setClient($client);
        $context->myInboxIsEmpty();
    }

    public function testShouldNotFindMessage(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('We found 0 messages from "no-reply@example.com" to "john.doe@example.com" with subject "Contact" with body "Body"');

        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects($this->once())
            ->method('findMessages')
            ->willReturnCallback(function (array $specifications) {
                $this->assertCount(4, $specifications);
                $this->assertArrayHasKey('sender', $specifications);
                $this->assertArrayHasKey('recipient', $specifications);
                $this->assertArrayHasKey('subject', $specifications);
                $this->assertArrayHasKey('body', $specifications);

                $sender = $specifications['sender'];
                $this->assertInstanceOf(SpecificationInterface::class, $sender);
                $this->assertSame('no-reply@example.com', (string) $sender);

                $recipient = $specifications['recipient'];
                $this->assertInstanceOf(SpecificationInterface::class, $recipient);
                $this->assertSame('john.doe@example.com', (string) $recipient);

                $subject = $specifications['subject'];
                $this->assertInstanceOf(SpecificationInterface::class, $subject);
                $this->assertSame('Contact', (string) $subject);

                $body = $specifications['body'];
                $this->assertInstanceOf(SpecificationInterface::class, $body);
                $this->assertSame('Body', (string) $body);

                return [];
            })
        ;

        $context = $this->getContext();
        $context->setClient($client);
        $context->iShouldSeeEmailWithSubjectAndBodyFromToRecipient(
            1,
            'no-reply@example.com',
            'john.doe@example.com',
            'Contact',
            'Body'
        );
    }

    public function testShouldFindMessage(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects($this->once())
            ->method('findMessages')
            ->willReturnCallback(function (array $specifications) {
                $this->assertCount(4, $specifications);
                $this->assertArrayHasKey('sender', $specifications);
                $this->assertArrayHasKey('recipient', $specifications);
                $this->assertArrayHasKey('subject', $specifications);
                $this->assertArrayHasKey('body', $specifications);

                $sender = $specifications['sender'];
                $this->assertInstanceOf(SpecificationInterface::class, $sender);
                $this->assertSame('no-reply@example.com', (string) $sender);

                $recipient = $specifications['recipient'];
                $this->assertInstanceOf(SpecificationInterface::class, $recipient);
                $this->assertSame('john.doe@example.com', (string) $recipient);

                $subject = $specifications['subject'];
                $this->assertInstanceOf(SpecificationInterface::class, $subject);
                $this->assertSame('Contact', (string) $subject);

                $body = $specifications['body'];
                $this->assertInstanceOf(SpecificationInterface::class, $body);
                $this->assertSame('Body', (string) $body);

                return [
                    'foo' => 'bar',
                ];
            })
        ;

        $context = $this->getContext();
        $context->setClient($client);
        $context->iShouldSeeEmailWithSubjectAndBodyFromToRecipient(
            1,
            'no-reply@example.com',
            'john.doe@example.com',
            'Contact',
            'Body'
        );
    }

    private function getContext(): FakeMailerContext
    {
        return new FakeMailerContext();
    }
}
