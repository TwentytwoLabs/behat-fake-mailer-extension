<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\ServiceContainer;

use Behat\Behat\Context\ServiceContainer\ContextExtension;
use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use TwentytwoLabs\BehatFakeMailerExtension\Initializer\FakeMailerInitializer;

final class BehatFakeMailerExtension implements ExtensionInterface
{
    public function process(ContainerBuilder $container)
    {
    }

    public function getConfigKey(): string
    {
        return 'fake_mailer_extension';
    }

    public function initialize(ExtensionManager $extensionManager): void
    {
    }

    public function configure(ArrayNodeDefinition $builder): void
    {
        $builder
            ->children()
                ->scalarNode('base_url')->defaultValue('http://localhost:8025')->end()
                ->scalarNode('client')->isRequired()->end()
            ->end()
        ;
    }

    /**
     * @param array<string, mixed> $config
     */
    public function load(ContainerBuilder $container, array $config): void
    {
        $client = new Definition($this->getClient($config['client']), ['$baseUrl' => $config['base_url']]);

        $mailpitInitializer = new Definition(FakeMailerInitializer::class, ['$client' => $client]);
        $mailpitInitializer->addTag(ContextExtension::INITIALIZER_TAG, ['priority' => 0]);

        $container->setDefinition('fake_mailer.context_initializer', $mailpitInitializer);
    }

    private function getClient(string $client): string
    {
        return match ($client) {
            'mailhog' => 'TwentytwoLabs\BehatFakeMailerExtension\Client\MailhogClient',
            'mailpit' => 'TwentytwoLabs\BehatFakeMailerExtension\Client\MailpitClient',
            default => $client,
        };
    }
}
