# Behat Fake Mailer Extension

A simple PHP (8.1+) [Behat] extension for fake mailer like [Mailhog](https://github.com/mailhog/MailHog) or [Mailpit](https://github.com/axllent/mailpit) for example.

## Installation

This package require Symfony HTTP client implementation.

The clients that come with this extension can be found in the table below.

| Client alias | How to Install                                             |
|--------------|------------------------------------------------------------|
| mailhug      | composer require twentytwo-labs/mailhog-fake-mailer-client |

[//]: # (| mailpit      | composer require twentytwo-labs/mailpit-fake-mailer-client |)

## Usage

### Register extension in Behat

Add the extension to your `behat.yml` like so:

```yaml
default:
  suites:
    # your suite configuration here
  extensions:
   TwentytwoLabs\BehatFakeMailerExtension:
      base_url: http://localhost:8025 # optional, defaults to 'http://localhost:8025'
      client: '<client alias or your class>'
```

The `base_url` is the URL where the Fake Mailer Web UI is listening to (by default this is `http://localhost:8025).

### Use FakeMailerContext

You must configure behat to use `TwentytwoLabs\BehatFakeMailerExtension\Context\FakeMailerContext`, so add this line in `behat.yaml`:

```yaml
default:
  suites:
    contexts:
       - TwentytwoLabs\BehatFakeMailerExtension\Context\FakeMailerContext: ~
```

This enables the following Gherkin for your scenarios to make assumptions on received email messages:

```gherkin
Given my inbox is empty # purge all emails
Then I should see 1 email
Then I should see 1 email from "no-reply@example.org"
Then I should see 1 email to "john.doe@example.org"
Then I should see 1 email with subject "Contact"
Then I should see 1 email with body "Lorem Ipsum"
Then I should see 1 email from "no-reply@example.org" to "john.doe@example.org"
Then I should see 1 email from "no-reply@example.org" with subject "Contact"
Then I should see 1 email from "no-reply@example.org" with body "Lorem Ipsum"
Then I should see 1 email to "john.doe@example.org" with subject "Contact"
Then I should see 1 email to "john.doe@example.org" with body "Lorem Ipsum"
Then I should see 1 email with subject "Contact" and body "Lorem Ipsum"
Then I should see 1 email from "no-reply@example.org" to "john.doe@example.org" with subject "Contact"
Then I should see 1 email from "no-reply@example.org" to "john.doe@example.org" with body "Lorem Ipsum"
Then I should see 1 email from "no-reply@example.org" with subject "Contact" and body "Lorem Ipsum"
Then I should see 1 email to "john.doe@example.org" with subject "Contact" and body "Lorem Ipsum"
Then I should see 1 email from "no-reply@example.org" to "john.doe@example.org" with subject "Contact" and body Lorem Ipsum"
```

### Implement your own client

1. First your need to create your client class which implement the `TwentytwoLabs\BehatFakeMailerExtension\Client\ClientInterface` interface
2. In your `behat.yaml` file:

```yaml
default:
  suites:
    # your suite configuration here
  extensions:
   TwentytwoLabs\BehatFakeMailerExtension:
      base_url: http://localhost:8025 # optional, defaults to 'http://localhost:8025'
      client: '<your class name with namespace>'
```
