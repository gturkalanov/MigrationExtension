<?php
/**
 * @author George Tarkalanov <g.turkalanov@gmail.com>
 */
namespace gtarkalanov\MigrationExtension\Context;


class MigrationContext extends RawMigrationContext
{
    /**
     * Initialize the multilingual context before the scenario.
     * @BeforeScenario
     * @Given /^I initialize multilingual context/
     */
    public function iInitializeMigrationContext() {
        $this->initializeMigration();
    }
}