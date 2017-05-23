<?php
/**
 * @author George Tarkalanov <g.turkalanov@gmail.com>
 */
namespace gtarkalanov\MigrationExtension\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Symfony\Component\Yaml\Yaml;
use Behat\MinkExtension;


class RawMigrationContext extends RawMinkContext implements MigrationContextInterface
{

    /**
     * Parameters of MultilingualExtension.
     *
     * @var array
     */
    public $db_url;
    public $db_name;
    public $mysql_username;
    public $mysql_password;
    public $migration_parameters = [];
    public $migration_map;

    /**
     * Constructor
     */
    public function __construct() {
        $source_tpye = $this->getMigrationParameter("source_type");
        $this->db_url = $this->getMigrationParameter("database_url");
        $this->db_name = $this->getMigrationParameter("database_name");
        $this->mysql_username = $this->getMigrationParameter("database_username");
        $this->mysql_password = $this->getMigrationParameter("database_password");
        //  $this->connectToDabase($db_url,$db_name,$mysql_username,$mysql_password);

        switch($source_tpye){
            case "mysql" :

                break;
            case "website" :

                break;
        }
    }

    /**
     * Set Migration paramaters to the migration_parameters array
     * @param array $parameters
     */
    public function setMigrationParameters(array $parameters)
    {
        if (empty($this->migration_parameters)) {
            $this->migration_parameters = $parameters;
        }
    }

    /**
     * Return exact parameter from YML file
     * @param string $name - The name of parameter from behat.yml
     * @return mixed
     */
    protected function getMigrationParameter($name)
    {
        return isset($this->migration_parameters[$name]) ? $this->migration_parameters[$name] : false;
    }

    /**
     * Parse Migration YML file
     */
    public function parseMigrationFile() {
        $base_path = $this->getMinkParameter('files_path');
        $base_path = $base_path."/";
        $file_path = $base_path.$this->migration_parameters['migration_map'];
        $yaml = file_get_contents($file_path);
        $yaml_parse_array_check = Yaml::parse($yaml);
        if(is_array($yaml_parse_array_check)) {
            $this->migration_map = $yaml_parse_array_check;
        }
    }

    /**
     * Check if the migration_map parameter is set and initialize call parsing function
     */
    public function initializeMigration() {
        if(isset($this->migration_parameters['migration_map'])) {
            $this->parseMigrationFile();
        }
        else {
            throw new \Exception (sprintf('You are trying to start testing a Website migration without YML file set in the profile property "migration_map"'));
        }
    }


    /**
     * Establish connection to a MySql instance
     *
     * @param $db_url - url to database
     * @param $db_name - database name
     * @param $username - mysql username
     * @param $password - mysql passowrd
     */
    public function connectToDabase($db_url,$db_name,$username,$password)
    {

        if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
            echo 'We don\'t have mysqli!!!';
        } else {
            echo 'Phew we have it!';
        }


        $db = new mysqli($db_url, $username, $password, $db_name);
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $result = mysqli_query($db,"SELECT location from watchdog");
        var_dump($result);
    }
}