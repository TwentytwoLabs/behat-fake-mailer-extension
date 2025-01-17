<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Context;

use Behat\Behat\Context\Context;
use TwentytwoLabs\BehatFakeMailerExtension\Client\ClientInterface;
use TwentytwoLabs\BehatFakeMailerExtension\Service\SpecificationService;

final class FakeMailerContext implements Context
{
    private ClientInterface $client;

    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @Given /^my inbox is empty$/
     */
    public function myInboxIsEmpty(): void
    {
        $this->client->purgeMessages();
    }

    /**
     * @Then /^I should see (?P<count>[^"]*) email$/
     * @Then /^I should see (?P<count>[^"]*) email from "(?P<from>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email to "(?P<recipient>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email with subject "(?P<subject>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email with body "(?P<body>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email from "(?P<from>[^"]*)" to "(?P<recipient>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email from "(?P<from>[^"]*)" with subject "(?P<subject>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email from "(?P<from>[^"]*)" with body "(?P<body>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email to "(?P<recipient>[^"]*)" with subject "(?P<subject>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email to "(?P<recipient>[^"]*)" with body "(?P<body>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email with subject "(?P<subject>[^"]*)" and body "(?P<body>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email from "(?P<from>[^"]*)" to "(?P<recipient>[^"]*)" with subject "(?P<subject>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email from "(?P<from>[^"]*)" to "(?P<recipient>[^"]*)" with body "(?P<body>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email from "(?P<from>[^"]*)" with subject "(?P<subject>[^"]*)" and body "(?P<body>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email to "(?P<recipient>[^"]*)" with subject "(?P<subject>[^"]*)" and body "(?P<body>[^"]*)"$/
     * @Then /^I should see (?P<count>[^"]*) email from "(?P<from>[^"]*)" to "(?P<recipient>[^"]*)" with subject "(?P<subject>[^"]*)" and body "(?P<body>[^"]*)"$/
     */
    public function iShouldSeeEmailWithSubjectAndBodyFromToRecipient(
        int $count,
        ?string $from = null,
        ?string $recipient = null,
        ?string $subject = null,
        ?string $body = null
    ): void {
        $specifications = SpecificationService::get($from, $recipient, $subject, $body);
        $messages = $this->client->findMessages($specifications);
        if (\count($messages) === $count) {
            return;
        }

        throw new \RuntimeException(
            sprintf(
                'We found %s messages%s%s%s%s',
                \count($messages),
                !empty($from) ? sprintf(' from "%s"', $from) : '',
                !empty($recipient) ? sprintf(' to "%s"', $recipient) : '',
                !empty($subject) ? sprintf(' with subject "%s"', $subject) : '',
                !empty($body) ? sprintf(' with body "%s"', $body) : ''
            )
        );
    }
}
