<?php


class Database
{
    private $_dbhost, $_dbport, $_dbname, $_charset, $_dsn, $_username, $_password;

    /**
     * @var $_pdo
     * contains the database connection
     */
    protected $_pdo;

    /**
     * Database constructor.
     * @param $_dbhost
     * @param $_dbport
     * @param $_dbname
     * @param $_charset
     * @param $_dsn
     * @param $_username
     * @param $_password
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

    private function establishPDO($_dsn, $_username, $_password)
    {
        try {

            $pdo = new PDO($_dsn, $_username, $_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Return the connection if it was successfully established
            return $pdo;

        }
        catch (PDOException $PDOException) {
            // Return null if no connection was established
            echo 'Connection failed: ' . $PDOException->getMessage();
            return null;
        }
        catch (Exception $exception) {
            // Return null if no connection was established
            echo 'Unexpected exception occured: ' . $exception->getMessage();
            return null;
        }
    }

    public function query($_sql, $_params, $_fetchMode = 'PDO::FETCH_ASSOC') {
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
                    $stmt->bindParam($key, $param);
                }
            }

            // Execute statement
            $stmt->execute();

            // Store result in array
            $returnArray = array();

            //TODO: Fetchmode?
            while ($row = $stmt->fetch()) {
                array_push($returnArray, $row);
            }

            return $returnArray;

        } catch (Exception $exception) {
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