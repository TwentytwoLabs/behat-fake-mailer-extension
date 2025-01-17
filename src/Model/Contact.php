<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Model;

final class Contact
{
    private string $emailAddress;
    private ?string $name = null;

    public function __construct(string $emailAddress, ?string $name = null)
    {
        $this->emailAddress = $emailAddress;
        $this->name = $name;
    }

    public static function fromString(string $data): self
    {
        $matches = [];
        if (preg_match('~^(?P<name>.*?)\s+<(?P<email>\S*?)>$~i', $data, $matches)) {
            return new self($matches['email'], stripslashes(trim($matches['name'])));
        }

        return new self($data);
    }

    public function equals(Contact $other): bool
    {
        if (null !== $this->name && null !== $other->name && $this->name !== $other->name) {
            return false;
        }

        return $this->emailAddress === $other->emailAddress;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
