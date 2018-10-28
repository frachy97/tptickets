<?php
namespace dao\db;

use \Exception as Exception;
use dao\IDAO as IDAO;
use model\Event as Event;    
use dao\db\Connection as Connection;

class EventDAO implements IDAO
{
    private $connection;
    private $tableName = "events";

    public function create($event) {
        try {
            $query = "INSERT INTO ".$this->tableName." (id_event, name, id_category) VALUES (:id_event, :name, :id_category);";

            $parameters["id_event"] = $event->getId();
            $parameters["name"] = $event->getName();
            $parameters["id_category"] = $event->getCategoryId();

            $this->connection = Connection::getInstance();

            $this->connection->executeNonQuery($query, $parameters);
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }

    public function retrieveAll() {
        try {
            $eventList = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($query);

            foreach ($resultSet as $row) {                
                $event = new Event($row["id_event"], $row["name"], $row["id_category"]);
                array_push($eventList, $event);
            }

            return $eventList;
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }

    public function retrieveById($id) {
        try {
            $event = null;

            $query = "SELECT * FROM ".$this->tableName." WHERE id_event = :id_event";

            $parameters["id_event"] = $id;

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($query, $parameters);

            foreach ($resultSet as $row) {
                $event = new Event($row["id_event"], $row["name"], $row["id_category"]);
            }

            return $event;
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM ".$this->tableName." WHERE id_event = :id_event";
            $parameters["id_event"] = $id;
            $this->connection = Connection::getInstance();
            $this->connection->executeNonQuery($query, $parameters);   
        }
        catch(Exception $ex) {
            throw $ex;
        }            
    }

    public function update($event) {
        try {
            $query = "UPDATE ".$this->tableName." SET name = :name, id_category = :id_category WHERE id_event = :id_event";
            $parameters["id_event"] = $event->getId();
            $parameters["name"] = $event->getName();
            $parameters["id_category"] = $event->getCategoryId();

            $this->connection = Connection::getInstance();
            $this->connection->executeNonQuery($query, $parameters);   
        }
        catch(Exception $ex) {
            throw $ex;
        }

    }
}
?>