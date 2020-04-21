<?php

namespace PlanningPoker\Model;

use PDO;

/**
 * Class Database:
 *
 * @package PlanningPoker\Model
 * @author Florian Drinkler, Luca Stanger
 */
class Database
{
    private $_dbhost, $_dbport, $_dbname, $_charset, $_dsn, $_username, $_password;

    public $_pdo;

    /**
     * Database constructor.
     * @param $_dbhost
     * @param $_dbport
     * @param $_dbname
     * @param $_username
     * @param $_password
     * @param string $_charset
     * @author Florian Drinkler
     * @return void
     */
    public function __construct($_dbhost, $_dbport, $_dbname, $_username, $_password, $_charset = 'utf8')
    {
        $this->setDbhost($_dbhost);
        $this->setDbport($_dbport);
        $this->setDbname($_dbname);
        $this->setUsername($_username);
        $this->setPassword($_password);
        $this->setCharset($_charset);
        $this->setDsn("mysql:host={$_dbhost};port={$_dbport};dbname={$_dbname};charset={$_charset}");

        // Build PDO Connection
        $this->_pdo = $this->establishPDO($this->getDsn(), $this->getUsername(), $this->getPassword());
    }

    /**
     * EstablishPDO: builds a pdo connection from scratch
     * @param $_dsn
     * @param $_username
     * @param $_password
     * @author Florian Drinkler
     * @return PDO|null
     */
    private function establishPDO($_dsn, $_username, $_password)
    {
        try {

            $pdo = new PDO($_dsn, $_username, $_password);
            /**
             * https://www.php.net/manual/en/pdo.error-handling.php
             *
             * Set Error Mode. At the moment it's in debug mode.
             */
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Return the connection if it was successfully established
            return $pdo;

        }
        catch (\PDOException $PDOException) {
            // Return null if no connection was established
            echo 'Connection failed: ' . $PDOException->getMessage();
            return null;
        }
        catch (\Exception $exception) {
            // Return null if no connection was established
            echo 'Unexpected exception occured: ' . $exception->getMessage();
            return null;
        }
    }

    /**
     * Query: queries the submitted sql with dynamic binding of parameters
     * @param $_sql
     * @param $_params
     * @author Luca Stanger
     * @return array|string
     */
    public function query($_sql, $_params) {
        // Guards
        if (!$_sql) {
            return 'Please submit a proper sql query';
        }
        if (!$this->_pdo) {
            return 'No proper connection established';
        }

        try {
            // Prepare statement
            $stmt = $this->_pdo->prepare($_sql);

            // Bind params
            if (isset($_params)) {
                foreach ($_params as $key=>$param) {
                    $tRet = $stmt->bindValue($key, $param);
                }
            }

            // Execute statement
            $tRet = $stmt->execute();

            // Store result in array
            $returnArray = array();

            //TODO: Fetchmode?
            while ($row = $stmt->fetch()) {
                array_push($returnArray, $row);
            }

            return $returnArray;

        } catch (\Exception $exception) {
            return 'Exception occured: ' . $exception->getMessage();
        }


    }

    /**
     * QueryWithoutFetch: queries the submitted sql with dynamic binding of parameters without fetching
     * @param $_sql
     * @param $_params
     * @author Luca Stanger
     * @return array|string
     */
    public function queryWithoutFetch($_sql, $_params) {
        // Guards
        if (!$_sql) {
            return 'Please submit a proper sql query';
        }
        if (!$this->_pdo) {
            return 'No proper connection established';
        }

        try {
            // Prepare statement
            $stmt = $this->_pdo->prepare($_sql);

            // Bind params
            if (isset($_params)) {
                foreach ($_params as $key=>$param) {
                    $tRet = $stmt->bindValue($key, $param);
                }
            }

            // Execute statement
            $tRet = $stmt->execute();

            // Store result in array
            $returnArray = array();

            return $returnArray;

        } catch (\Exception $exception) {
            return 'Exception occured: ' . $exception->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getDbhost()
    {
        return $this->_dbhost;
    }

    /**
     * @param mixed $dbhost
     */
    public function setDbhost($dbhost)
    {
        $this->_dbhost = $dbhost;
    }

    /**
     * @return mixed
     */
    public function getDbport()
    {
        return $this->_dbport;
    }

    /**
     * @param mixed $dbport
     */
    public function setDbport($dbport)
    {
        $this->_dbport = $dbport;
    }

    /**
     * @return mixed
     */
    public function getDbname()
    {
        return $this->_dbname;
    }

    /**
     * @param mixed $dbname
     */
    public function setDbname($dbname)
    {
        $this->_dbname = $dbname;
    }

    /**
     * @return mixed
     */
    public function getCharset()
    {
        return $this->_charset;
    }

    /**
     * @param mixed $charset
     */
    public function setCharset($charset)
    {
        $this->_charset = $charset;
    }

    /**
     * @return string
     */
    public function getDsn(): string
    {
        return $this->_dsn;
    }

    /**
     * @param string $dsn
     */
    public function setDsn(string $dsn)
    {
        $this->_dsn = $dsn;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getConn()
    {
        return $this->_conn;
    }

    /**
     * @param mixed $conn
     */
    public function setConn($conn)
    {
        $this->_conn = $conn;
    }


}
