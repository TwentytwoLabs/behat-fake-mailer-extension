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
        if (preg_match('~(?P<name>.*?)\s+<(?P<email>\S*?)>~', $data, $matches)) {
            return new self($matches['email'], stripslashes(trim($matches['name'])));
        }

        return new self(trim($data));
    }

    public function equals(Contact $other): bool
    {
        if ($this->name !== $other->getName()) {
            return false;
        }

        if ($this->emailAddress !== $other->getEmailAddress()) {
            return false;
        }

        return true;
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
