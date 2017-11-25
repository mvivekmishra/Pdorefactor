<?php
//turn on debugging messages
//ini_set('display_errors', 'On');
error_reporting(E_ERROR );
define('DATABASE', 'vm368');
define('USERNAME', 'vm368');
define('PASSWORD', 'o2dwjU2Q');
define('CONNECTION', 'sql2.njit.edu');

class pdoactive {
    public static function autoload($class) {
        //you can put any file name or directory here
        include $class . '.php';
    }
}
spl_autoload_register(array('pdoactive', 'autoload'));

//For directory struture { root to current}
/*class Autoloader {
    static public function loader($className) {
        $filename = "final/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
spl_autoload_register('Autoloader::loader');*/



//namespace execution for pdo

use pdo\htmlTable;
$obj=new htmlTable;
$obj = new main();

class main
{
    public function __construct()
	{
		
        //Print complete record set @vm368---->
		
		
		
		$records = todos::findAll();
        $tableGen = htmlTable::genarateTable($records);
        
        //Print One record @vm368---->
		
		$id=124;
        $records = todos::findOne($id);
		$tableGen = htmlTable::genarateTable($records);
        
        //insert one record @vm368----->
        
        $record = new todo();
        $record->id=' ';
		$record->owneremail="vm368@njit.edu";
        $record->ownerid=11;
        $record->createddate="00-00-xxxx";
        $record->duedate="xx-xx-xxxx";
        $record->message="hello";
        $record->isdone=1;
		$record->save();
        $records = todos::findAll();
		$tableGen = htmlTable::genarateTable($records);
        
        //update one record @vm368----->
        
        //$id=1010;
        $record = new todo();
        $record->id=101;
        $record->owneremail="vm368@njit.edu";
        $record->message="How are you doing?";
        $record->save();
		
		//print after save ----->
		$records = todos::findAll();
		$tableGen = htmlTable::genarateTable($records);
        
        //delete one record @vm368---->
        
        $record= new todo();
        $record->delete(195);
		
		$records = todos::findAll();
		$tableGen = htmlTable::genarateTable($records);
        
    
	}
}
?>
