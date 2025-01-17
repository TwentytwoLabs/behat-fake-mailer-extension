<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Client;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;
use TwentytwoLabs\BehatFakeMailerExtension\Specification\SpecificationInterface;

abstract class AbstractClient implements ClientInterface
{
    protected HttpClientInterface $client;
    protected string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->client = HttpClient::create();
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param SpecificationInterface[] $specifications
     */
    protected function isMatching(array $specifications, Mail $mail): bool
    {
        foreach ($specifications as $specification) {
            if (!$specification->isSatisfiedBy($mail)) {
                return false;
            }
        }

        return true;
    }
}
