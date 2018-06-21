<?php
require_once '../usuario/check.php'; 
require_once '../usuario/isAdmin.php'; 

echo backup_tables("localhost","root","","avap");
$fecha=date("Y-m-d");
header("Content-disposition: attachment; filename=db-backup-".$fecha.".sql");
header("Content-type: MIME");
readfile("../../backups/db-backup-".$fecha.".sql");

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
   $return='';
   $link = new mysqli($host,$user,$pass,$name);
  // mysql_select_db($name,$link);
   
   //get all of the tables
   if($tables == '*')
   {
      $tables = array();
      $result = $link->query('SHOW TABLES');
      while($row = mysqli_fetch_row($result))
      {
         $tables[] = $row[0];
      }
   }
   else
   {
      $tables = is_array($tables) ? $tables : explode(',',$tables);
   }
   
   //cycle through
   foreach($tables as $table)
   {
      $result = $link->query('SELECT * FROM '.$table);
      $num_fields = mysqli_num_fields($result);

      
      //$return.= 'DROP TABLE '.$table.';';
      $row2 = mysqli_fetch_row($link->query('SHOW CREATE TABLE '.$table));
      $return.= "\n\n".$row2[1].";\n\n";
      
    for ($i = 0; $i < $num_fields; $i++)
      {
         while($row = mysqli_fetch_row($result))
         {
            $return.= 'INSERT INTO '.$table.' VALUES(';
            for($j=0; $j<$num_fields; $j++) 
            {
               $row[$j] = addslashes($row[$j]);
               $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
               if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
               if ($j<($num_fields-1)) { $return.= ','; }
            }
            $return.= ");\n";
         }
      }
      $return.="\n\n\n";
   }
   $fecha=date("Y-m-d");
   //save file
   $handle = fopen('../../backups/db-backup-'.$fecha.'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
}

?>

