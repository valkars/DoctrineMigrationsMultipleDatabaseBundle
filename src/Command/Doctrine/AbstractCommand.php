<?php

namespace AvaiBookSports\Bundle\MigrationsMultipleDatabase\Command\Doctrine;

use AvaiBookSports\Bundle\MigrationsMultipleDatabase\Configuration\Configuration;
use Doctrine\Migrations\DependencyFactory;
use Symfony\Component\Console\Command\Command;

abstract class AbstractCommand extends Command
{
    public function __construct(private readonly Configuration $configuration)
    {
        parent::__construct();
    }

    /**
     * @return DependencyFactory[]
     *
     * @throws \RuntimeException
     */
    public function getDependencyFactories(?string $entityManager = null): array
    {
        $dependencyFactories = [];

        if (null === $entityManager || '' === $entityManager) {
            $dependencyFactories = $this->configuration->getDependencyFactories();
        } elseif (null !== $this->configuration->getConfigurationByEntityManagerName($entityManager)) {
            $dependencyFactories = [$this->configuration->getConfigurationByEntityManagerName($entityManager)];
        }

        if (0 === count($dependencyFactories)) {
            throw new \RuntimeException('No entity manager found');
        }

        return $dependencyFactories;
    }
}
