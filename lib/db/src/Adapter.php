<?php
namespace Phlib\Db;

use Phlib\Db\Exception\InvalidQueryException;
use Phlib\Db\Exception\UnknownDatabaseException;
use Phlib\Db\Exception\RuntimeException;

class Adapter implements AdapterInterface
{
    use Adapter\CrudTrait;

    /**
     *
     * @var Adapter\Config
     */
    private $config;

    /**
     *
     * @var \PDO
     */
    private $connection = null;

    /**
     *
     * @var callable
     */
    private $connectionFactory;

    /**
     *
     * @var Adapter\QuoteHandler
     */
    private $quoter;

    /**
     * Constructor
     *
     * === Config Params ===
     * host
     * username
     * password
     * [port]
     * [dbname]
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = new Adapter\Config($config);
        $this->connectionFactory = new Adapter\ConnectionFactory();
    }

    /**
     *
     * @return Adapter\QuoteHandler
     */
    public function quote()
    {
        if (! isset($this->quoter)) {
            $this->quoter = new Adapter\QuoteHandler(function ($value, $type) {
                return $this->getConnection()->quote($value, $type);
            });
        }

        return $this->quoter;
    }

    /**
     * Sets the item which creates a new DB connection.
     *
     * @param callable $factory
     * @return $this
     */
    public function setConnectionFactory(callable $factory)
    {
        $this->connectionFactory = $factory;
        return $this;
    }

    /**
     * Magic method to clone the object.
     */
    public function __clone()
    {
        // close our existing connection, we'll create a new one when we need it
        $this->closeConnection();
    }

    /**
     * Close connection
     *
     * @return void
     */
    public function closeConnection()
    {
        $this->connection = null;
    }

    /**
     * Reconnects the database connection.
     *
     * @return Adapter
     */
    public function reconnect()
    {
        $this->connection = null;
        $this->connect();

        return $this;
    }

    /**
     * Get the database connection.
     *
     * @return \PDO
     */
    public function getConnection()
    {
        $this->connect();

        return $this->connection;
    }

    /**
     * Set the database connection.
     *
     * @param \PDO $connection
     * @return Adapter
     */
    public function setConnection(\PDO $connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Set database
     *
     * @param string $dbname
     * @return Adapter
     * @throws UnknownDatabaseException
     */
    public function setDatabase($dbname)
    {
        $this->config->setDatabase($dbname);
        if ($this->connection) {
            try {
                $this->query('USE ' . $this->quote()
                    ->identifier($dbname));
            } catch (RuntimeException $exception) {
                /** @var \PDOException $prevException */
                $prevException = $exception->getPrevious();
                if (UnknownDatabaseException::isUnknownDatabase($prevException)) {
                    throw UnknownDatabaseException::createFromUnknownDatabase($dbname, $prevException);
                }

                throw $exception;
            }
        }

        return $this;
    }

    /**
     * Get the config for the database connection.
     * This could be empty if the
     * object was created with an empty array.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config->toArray();
    }

    /**
     * Set the character set on the connection.
     *
     * @param string $charset
     * @return Adapter
     */
    public function setCharset($charset)
    {
        if ($this->config->getCharset() !== $charset) {
            $this->config->setCharset($charset);
            if ($this->connection) {
                $this->query('SET NAMES ?', [
                    $charset
                ]);
            }
        }

        return $this;
    }

    /**
     * Set the timezone on the connection.
     *
     * @param string $timezone
     * @return Adapter
     */
    public function setTimezone($timezone)
    {
        if ($this->config->getTimezone() !== $timezone) {
            $this->config->setTimezone($timezone);
            if ($this->connection) {
                $this->query('SET time_zone = ?', [
                    $timezone
                ]);
            }
        }

        return $this;
    }

    /**
     * Enable connection buffering on queries.
     *
     * @return Adapter
     */
    public function enableBuffering()
    {
        return $this->setBuffering(true);
    }

    /**
     * Disable connection buffering on queries.
     *
     * @return Adapter
     */
    public function disableBuffering()
    {
        return $this->setBuffering(false);
    }

    /**
     * Returns whether the connection is set to buffered or not.
     * By default
     * it's true, all results are buffered.
     *
     * @return boolean
     */
    public function isBuffered()
    {
        return (bool) $this->getConnection()->getAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY);
    }

    /**
     * Sets whether the connection is buffered or unbuffered.
     * By default the
     * connection is buffered.
     *
     * @param boolean $enabled
     * @return Adapter
     */
    private function setBuffering($enabled)
    {
        $this->getConnection()->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, $enabled);
        return $this;
    }

    /**
     * Ping the database connection to make sure the connection is still alive.
     *
     * @return boolean
     */
    public function ping()
    {
        try {
            return ($this->query('SELECT 1')->fetchColumn() == 1);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the last inserted id.
     * If the tablename is provided the id returned is
     * the last insert id will be for that table.
     *
     * @param string $tablename
     * @return integer
     */
    public function lastInsertId($tablename = null)
    {
        // the lastInsertId is cached from the last insert, so no point in detected disconnection
        return $this->getConnection()->lastInsertId($tablename);
    }

    /**
     * Prepare an SQL statement for execution.
     *
     * @param string $statement
     * @return \PDOStatement
     */
    public function prepare($statement)
    {
        // the prepare method is emulated by PDO, so no point in detected disconnection
        return $this->getConnection()->prepare($statement);
    }

    /**
     * Execute an SQL statement
     *
     * @param string $statement
     * @param array $bind
     * @return int
     */
    public function execute($statement, array $bind = [])
    {
        $stmt = $this->query($statement, $bind);
        return $stmt->rowCount();
    }

    /**
     * Query the database.
     *
     * @param string $sql
     * @param array $bind
     * @throws \PDOException
     * @return \PDOStatement
     */
    public function query($sql, array $bind = [])
    {
        return $this->doQuery($sql, $bind);
    }

    /**
     *
     * @param string $sql
     * @param array $bind
     * @param bool $hasCaughtException
     * @return \PDOStatement
     */
    private function doQuery($sql, array $bind, $hasCaughtException = false)
    {
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($bind);
            return $stmt;
        } catch (\PDOException $exception) {
            if (InvalidQueryException::isInvalidSyntax($exception)) {
                throw new InvalidQueryException($sql, $bind, $exception);
            } elseif (RuntimeException::hasServerGoneAway($exception) && ! $hasCaughtException) {
                $this->reconnect();
                return $this->doQuery($sql, $bind, true);
            }
            throw RuntimeException::createFromException($exception);
        }
    }

    /**
     * Connect
     *
     * @return Adapter
     */
    private function connect()
    {
        if (is_null($this->connection)) {
            $this->connection = call_user_func($this->connectionFactory, $this->config);
        }

        return $this;
    }

    /**
     * Clone connection
     *
     * @return \PDO
     */
    public function cloneConnection()
    {
        return call_user_func($this->connectionFactory, $this->config);
    }

    /**
     *
     * @return bool
     */
    public function beginTransaction()
    {
        return $this->doBeginTransaction();
    }

    /**
     *
     * @param bool $hasCaughtException
     * @return bool
     */
    private function doBeginTransaction($hasCaughtException = false)
    {
        try {
            return $this->getConnection()->beginTransaction();
        } catch (\PDOException $exception) {
            if (RuntimeException::hasServerGoneAway($exception) && ! $hasCaughtException) {
                $this->reconnect();
                return $this->doBeginTransaction(true);
            }
            throw RuntimeException::createFromException($exception);
        }
    }

    /**
     *
     * @return bool
     */
    public function commit()
    {
        return $this->getConnection()->commit();
    }

    /**
     *
     * @return bool
     */
    public function rollBack()
    {
        return $this->getConnection()->rollBack();
    }
}
