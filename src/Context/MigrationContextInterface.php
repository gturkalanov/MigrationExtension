<?php
/**
 * @author George Tarkalanov <g.turkalanov@gmail.com>
 */
namespace gtarkalanov\MigrationExtension\Context;
use Behat\Behat\Context\Context;

interface MigrationContextInterface extends Context
{
    /**
     * Set parameters from behat.yml.
     *
     * @param array $parameters
     *   An array of parameters from configuration file.
     */
    public function setMigrationParameters(array $parameters);
}