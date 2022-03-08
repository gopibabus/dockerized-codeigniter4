<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     *
     * @var string
     */
    public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     *
     * @var string
     */
    public $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array
     */
    public $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => '',
        'password' => '',
        'database' => '',
        'schema' => '',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     *
     * @var array
     */
    public $tests = [
        'DSN'      => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'schema' => '',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    public function __construct()
    {
        // Database
        if (getenv('DATABASE_HOSTNAME')) {
            $this->default['hostname'] = getenv('DATABASE_HOSTNAME');
        }
        if (getenv('DATABASE_USERNAME')) {
            $this->default['username'] = getenv('DATABASE_USERNAME');
        }
        if (getenv('DATABASE_PASSWORD')) {
            $this->default['password'] = getenv('DATABASE_PASSWORD');
        }
        if (getenv('DATABASE_NAME')) {
            $this->default['database'] = getenv('DATABASE_NAME');
        }
        if (getenv('DATABASE_DRIVER')) {
            $this->default['DBDriver'] = getenv('DATABASE_DRIVER');
        }
        if (getenv('DATABASE_PREFIX')) {
            $this->default['DBPrefix'] = getenv('DATABASE_PREFIX');
        }
        if (getenv('DATABASE_PORT')) {
            $this->default['port'] = getenv('DATABASE_PORT');
        }
        if (getenv('DATABASE_SCHEMA')) {
            $this->default['schema'] = getenv('DATABASE_SCHEMA');
        }

        //Test Database
        if (getenv('TEST_DATABASE_HOSTNAME')) {
            $this->tests['hostname'] = getenv('TEST_DATABASE_HOSTNAME');
        }
        if (getenv('DATABASE_USERNAME')) {
            $this->tests['username'] = getenv('TEST_DATABASE_USERNAME');
        }
        if (getenv('TEST_DATABASE_PASSWORD')) {
            $this->tests['password'] = getenv('TEST_DATABASE_PASSWORD');
        }
        if (getenv('TEST_DATABASE_NAME')) {
            $this->tests['database'] = getenv('TEST_DATABASE_NAME');
        }
        if (getenv('TEST_DATABASE_DRIVER')) {
            $this->tests['DBDriver'] = getenv('TEST_DATABASE_DRIVER');
        }
        if (getenv('TEST_DATABASE_PREFIX')) {
            $this->tests['DBPrefix'] = getenv('TEST_DATABASE_PREFIX');
        }
        if (getenv('TEST_DATABASE_SCHEMA')) {
            $this->default['schema'] = getenv('TEST_DATABASE_SCHEMA');
        }

        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
