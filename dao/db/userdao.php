<?php
    namespace dao\db;

    use \Exception as Exception;
    use dao\IDAO as IDAO;
    use model\User as User;    
    use dao\db\Connection as Connection;

    class UserDAO implements IDAO
    {
        private $connection;
        private $tableName = "users";

        public function create($user) {
            try {
                $query = "INSERT INTO ".$this->tableName." (id_user, email, password, first_name, last_name, is_admin) VALUES (:id_user, :email, :password, :first_name, :last_name, :is_admin);";
                
                $parameters["id_user"] = $user->getId();
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();
                $parameters["first_name"] = $user->getFirstname();
                $parameters["last_name"] = $user->getLastname();
                //casteo para la tabla (admite solo 0 y 1 (tinyint))
                $parameters["is_admin"] = (bool) $user->isAdmin();

                $this->connection = Connection::getInstance();

                $this->connection->executeNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function retrieveAll() {
            try {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->execute($query);
                
                foreach ($resultSet as $row) {                
                    $user = new User($row["id_user"], $row["email"], $row["password"], $row["first_name"], $row["last_name"], $row["is_admin"]);
                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function retrieveById($id) {
            try {
                $user = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE id_user = :id_user";
                
                $parameters["id_user"] = $id;
                
                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->execute($query, $parameters);
                
                foreach ($resultSet as $row) {
                    $user = new User($row["id_user"], $row["email"], $row["password"], $row["first_name"], $row["last_name"], $row["is_admin"]);
                }
                            
                return $user;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function delete($id) {
            try {
                $query = "DELETE FROM ".$this->tableName." WHERE id_user = :id_user";
                $parameters["id_user"] = $id;
                $this->connection = Connection::getInstance();
                $this->connection->executeNonQuery($query, $parameters);   
            }
            catch(Exception $ex) {
                throw $ex;
            }            
        }

        public function update($user) {
            try {
                $query = "UPDATE ".$this->tableName." SET email = :email, password = :password, first_name = :first_name, last_name= :last_name, is_admin = :is_admin WHERE id_user = :id_user";
                $parameters["id_user"] = $user->getId();
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();
                $parameters["first_name"] = $user->getFirstname();
                $parameters["last_name"] = $user->getLastname();
                $parameters["is_admin"] = $user->isAdmin();

                $this->connection = Connection::getInstance();
                $this->connection->executeNonQuery($query, $parameters);   
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }
    }
?>