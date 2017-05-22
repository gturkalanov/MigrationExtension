<?php
/**
 * @author George Tarkalanov <g.turkalanov@gmail.com>
 */
namespace gtarkalanov\MigrationExtension\Context;


class RawMigrationContext implements MigrationContextInterface
{
    /**
     * Parameters of MultilingualExtension.
     *
     * @var array
     */
    public $migration_parameters = [];
    /**
     * {@inheritdoc}
     */
    public function setMigrationParameters(array $parameters)
    {
        if (empty($this->migration_parameters)) {
            $this->migration_parameters = $parameters;
        }
    }

    /**
     * @param string $name
     *   The name of parameter from behat.yml.
     *
     * @return mixed
     */
    protected function getMigrationParameter($name)
    {
        return isset($this->migration_parameters[$name]) ? $this->migration_parameters[$name] : false;
    }
}