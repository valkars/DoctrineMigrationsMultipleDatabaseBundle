<?php

namespace AvaiBookSports\Bundle\MigrationsMultipleDatabase\Configuration;

use Doctrine\Migrations\DependencyFactory;

class Configuration
{
    /** @var DependencyFactory[] */
    private array $dependencyFactories = [];

    public function addDependencyFactory(string $name, DependencyFactory $entityManager): self
    {
        $this->dependencyFactories[$name] = $entityManager;

        return $this;
    }

    /**
     * @return DependencyFactory[]
     */
    public function getDependencyFactories(): array
    {
        return $this->dependencyFactories;
    }

    /**
     * @return string[]
     */
    public function getEntityManagerNames(): array
    {
        return array_keys($this->dependencyFactories);
    }

    public function getConfigurationByEntityManagerName(string $name): ?DependencyFactory
    {
        return $this->dependencyFactories[$name] ?? null;
    }
}
