<?php
namespace category\model;

use Exception;
use PDO;
use PDOException;
use database\DataBase;

class Category{
    private $id;
    private $name;

    public function create($dataBase = null){
        try {
            // Verify to close transaction.
            $closeTransaction = false;

            if ($dataBase == null) {

                $closeTransaction = true;

                // Open the database connection
                $dataBase = DataBase::connect();

                // Set the error reporting attribute
                $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Begin the transaction
                $dataBase->beginTransaction();
            }

            // Prepare the SQL statement
            $sql = $dataBase->prepare("INSERT INTO category.category
											(name)
											VALUES (?) RETURNING id");

            // Bind values
            $sql->bindValue(1, $this->name);
            
            // Execute the prepared statement
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);

            if ($closeTransaction) {
                // Commit the transaction
                $dataBase->commit();

                // Close the database connection
                $dataBase = null;
            }

            return $result['id'];
        } catch (PDOException $e) {
            // Rollback the transaction
            if (isset( $dataBase )) $dataBase->rollBack();
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            // Rollback the transaction
            if (isset( $dataBase )) $dataBase->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function read($dataBase = null){
        try {
            // Verify to close transaction.
            $closeTransaction = false;

            if ($dataBase == null) {
                $closeTransaction = true;
                // Open the database connection
                $dataBase = DataBase::connect();
                // Set the error reporting attribute
                $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Begin the transaction
                $dataBase->beginTransaction();
            }

            $sqlWhere      = "";
            $sqlParameters = array();

            if (isset($this->id)) {
				$sqlWhere .= " AND id = ?";
				array_push ( $sqlParameters, $this->id );
			}
            if (isset($this->name)) {
                $sqlWhere .= " AND name ILIKE  ?";
                array_push($sqlParameters, "%".$this->name."%");
            }
            
            // Prepare the SQL statement
            $sql = $dataBase->prepare("SELECT * FROM category.category
											WHERE 1=1 " . $sqlWhere . " order by name");

            // Execute the prepared statement
            $sql->execute($sqlParameters);

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

            if ($closeTransaction) {
                // Commit the transaction
                $dataBase->commit();
                // Close the database connection
                $dataBase = null;
            }

            return $result;
        } catch (PDOException $e) {
            // Rollback the transaction
            if (isset( $dataBase )) $dataBase->rollBack();
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            // Rollback the transaction
            if (isset( $dataBase )) $dataBase->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function update($dataBase = null){
        try {
            // Verify to close transaction.
            $closeTransaction = false;

            if ($dataBase == null) {
                $closeTransaction = true;
                // Open the database connection
                $dataBase = DataBase::connect();
                // Set the error reporting attribute
                $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Begin the transaction
                $dataBase->beginTransaction();
            }

            $sqlFileds = array();
            $sqlValues = array();

            if(isset($this->id) && $this->id){
                $sqlFileds[] = "id=:id";
                $sqlValues[':id'] = $this->id;
            }
            if (isset($this->name)) {
                $sqlFileds[] = "name=:name";
                $sqlValues[':name'] = $this->name;
            }
            
            // Concat all fields that should been updated as a string, separated by comma
            $sqlFileds = ( count($sqlFileds) > 0 ) ? implode(', ', $sqlFileds) : null;

            // Verfy if exists any change
            if (empty($sqlFileds)) {
                throw new Exception('Erro ao atualizar dados, não foi possível localizar nenhuma alteração a ser realizada.');
            }

            // Prepare the SQL statement
            $sql = $dataBase->prepare("UPDATE category.category SET {$sqlFileds} WHERE id=:id RETURNING id");

            // Execute the prepared statement
            $sql->execute($sqlValues);

            if ($closeTransaction) {
                // Commit the transaction
                $dataBase->commit();
                // Close the database connection
                $dataBase = null;
            }

            return $this->id;
        } catch (PDOException $e) {
            // Rollback the transaction
            if (isset( $dataBase )) $dataBase->rollBack();
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            // Rollback the transaction
            if (isset( $dataBase )) $dataBase->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function delete($dataBase = null){
        try{
            // Verify to close transaction.
            $closeTransaction = false;

            if ($dataBase == null) {
                $closeTransaction = true;
                // Open the database connection
                $dataBase = DataBase::connect();
                // Set the error reporting attribute
                $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Begin the transaction
                $dataBase->beginTransaction();
            }
            
            $sql = $dataBase->prepare("DELETE FROM category.category WHERE id = :id;");
            
            $sql->bindValue(':id', $this->id);
            
            $sql->execute();
            
            if ($closeTransaction) {
                // Commit the transaction
                $dataBase->commit();
                // Close the database connection
                $dataBase = null;
            }
            
            return true;
        } catch (PDOException $e) {
            // Rollback the transaction
            if (isset( $dataBase )) $dataBase->rollBack();
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            // Rollback the transaction
            if (isset( $dataBase )) $dataBase->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }
}