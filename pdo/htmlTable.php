<?php
namespace pdo;
class htmlTable{
    public function genarateTable($record){
		$tableGen = '<table border="1" cellpadding="2" cellspacing="3">';
		
		if($record==1)
		{
			$tableGen .= '<tr>';
			foreach($record as $key => $value){
				$tableGen .= '<td>' . $value.'</td>';
			}
			$tableGen.='</tr>';
			
		}
		elseif($record>1){
            foreach($record as $row => $innerArray){
            $tableGen .= '<tr>';
            foreach($innerArray as $innerRow => $value){
                
				$tableGen .= '<td>' . $value.'</td>';
							 
            }
			$tableGen.='</tr>';
		}
		}
        $tableGen .= '</table>';
        print_r($tableGen);
    }
}
