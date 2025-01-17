<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Model;

final class Mail
{
    private string $messageId;
    private Contact $sender;
    /** @var Contact[] */
    private array $recipients;
    /** @var Contact[] */
    private array $ccRecipients;
    /** @var Contact[] */
    private array $bccRecipients;
    private string $subject;
    private string $body;

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function setMessageId(string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function getSender(): Contact
    {
        return $this->sender;
    }

    public function setSender(Contact $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipients(): array
    {
        return $this->recipients;
    }

    public function setRecipients(array $recipients): self
    {
        $this->recipients = $recipients;

        return $this;
    }

    public function getCcRecipients(): array
    {
        return $this->ccRecipients;
    }

    public function setCcRecipients(array $ccRecipients): self
    {
        $this->ccRecipients = $ccRecipients;

        return $this;
    }

    public function getBccRecipients(): array
    {
        return $this->bccRecipients;
    }

    public function setBccRecipients(array $bccRecipients): self
    {
        $this->bccRecipients = $bccRecipients;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
