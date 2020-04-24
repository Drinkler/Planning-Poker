<?php

namespace PlanningPoker\Model;

/**
 * Class ModelBase:
 *
 * @package PlanningPoker\Model
 * @author Luca Stanger
 */
abstract class ModelBase
{
    private static $_db;

    /**
     * GetPDO: returns a PDO Connection
     * @author Luca Stanger
     * @return Database
     */
    public function getPdo()
    {
        if (self::$_db === null) {
            self::$_db = new \PlanningPoker\Model\Database(
                $_SERVER['RDS_HOSTNAME'],
                $_SERVER['RDS_PORT'],
                $_SERVER['RDS_DB_NAME'],
                $_SERVER['RDS_USERNAME'],
                $_SERVER['RDS_PASSWORD'],
                'utf8'
            );
        }

        return self::$_db;
    }

    /**
     * FindByID: generic method for finding a entry by its id
     * @param $_id
     * @author Luca Stanger
     * @return array|bool|string
     */
    public static function findById($_id)
    {
        $model = new static();
        $table = $model->getSource();
        $pdo = $model->getPdo();

        if (is_int($_id)) {
            // we are looking for an ID
            $id = 'id' . $table;
            $query = 'SELECT * FROM `' . $table . '` WHERE ' . $id . ' = :' . $id . ' LIMIT 1';

            $params = array(
                strval($id) => $_id
            );


            return $pdo->query($query, $params);
        }
        return false;
        #return $stmt->fetchObject(get_class($model));
    }

    /**
     * DeleteById: generic method for deleting a entry by its id
     * @param $_id
     * @author Florian Drinkler
     * @return array|bool|string
     */
    public static function deleteById($_id)
    {
        $model = new static();
        $table = $model->getSource();
        $pdo = $model->getPdo();

        if (is_int($_id)) {
            // we are looking for an ID
            $id = 'id' . $table;
            $query = 'DELETE FROM `' . $table . '` WHERE ' . $id . ' = :' . $id . ' LIMIT 1';

            $params = array(
                strval($id) => $_id
            );


            return $pdo->query($query, $params);
        }
        return false;
    }

    /**
     * GetSource: returns the table name
     * @return string
     */
    abstract public function getSource();
}
