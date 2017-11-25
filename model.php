<?php
//making model class abstract
abstract class model {
	protected $id;
    public function save(){
		
		$array = get_object_vars($this);
		foreach($array as $value){
		$t= $value;
		break;
		}
		if(is_int($t) == 1) {
            $sql = $this->update();
			//echo 'id is null';
        } else {
           $sql = $this->insert();
		  // echo 'id is not null';
        }
		$db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $array = get_object_vars($this);
        foreach (array_flip($array) as $key=>$value){
			$statement->bindParam(":$value", $this->$value);
        }
        $statement->execute();
		$id=$db->lastInsertId();
		echo '</br>';
		echo "Record Saved";
		echo '</br>';
		return $id;
    }
    private function insert() {
        $modelName=static::$modelName;
        $tableName = $modelName::getTablename();
        $array = get_object_vars($this);
        $columnString = implode(',', array_flip($array));
        $valueString = ':'.implode(',:', array_flip($array));
        $sql =  'INSERT INTO '.$tableName.' ('.$columnString.') VALUES ('.$valueString.')';
        echo $sql;
		echo '</br>';
		echo "record inserted";
		return $sql;
    }
    private function update() {
        $modelName=static::$modelName;
        $tableName = $modelName::getTablename();
        $array = get_object_vars($this);
        $comma = " ";
        $sql = 'UPDATE '.$tableName.' SET ';
        foreach ($array as $key=>$value){
            if( ! empty($value))//&& ($value!=$id)) 
			{
                $sql .= $comma . $key . ' = "'. $value .'"';
                $comma = ", ";
            }
        }
        $sql .= ' WHERE id='.$this->id;
        echo $sql;
		return $sql;
    }
    public function delete($di) {
		$array = get_object_vars($this);
		foreach($array as $value){
			$t= $value;
			break;
		}
        $db = dbConn::getConnection();
        $modelName=static::$modelName;
        $tableName = $modelName::getTablename();
        $sql = 'DELETE FROM '.$tableName.' WHERE id='.$di;
        echo $sql;
        $statement = $db->prepare($sql);
        $statement->execute();
		echo " One record deleted";
    }
}