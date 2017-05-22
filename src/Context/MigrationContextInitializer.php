<?php
/**
 * @author George Tarkalanov <g.turkalanov@gmail.com>
 */
namespace gtarkalanov\MigrationExtension\Context;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;


class MigrationContextInitializer implements ContextInitializer
{
    /**
     * Parameters of MigrationExtension.
     *
     * @var array
     */
    private $migration_parameters = [];
    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->migration_parameters = $parameters;
    }
    /**
     * {@inheritdoc}
     */
    public function initializeContext(Context $context)
    {
        if ($context instanceof MigrationContextInterface) {
            $context->setMigrationParameters($this->migration_parameters);
        }
    }
}