<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDO;

class BackupController extends Controller
{
    public function index()
    {
        $connect = new PDO("mysql:host=127.0.0.1;dbname=vetopetocare", "vetopetocare", "24846912");
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
        return view('admin.backup.index',compact('result'));
    }
    
    
    public function backUp()
    {
        
        if (isset($_POST['backup']))
        {   
        // Database configuration
        $host = "127.0.0.1";
        $username = "vetopetocare";
        $password = "24846912";
        $database_name = "vetopetocare";
        // Get connection object and set the charset
        $conn = mysqli_connect($host, $username, $password, $database_name);
        $conn->set_charset("utf8");
        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
        }
        $sqlScript = "";
        foreach ($tables as $table) {
        // Prepare SQLscript for creating table structure
        $query = "SHOW CREATE TABLE $table";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
        
        
        $query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $query);
        
        $columnCount = mysqli_num_fields($result);
        
        // Prepare SQLscript for dumping data for each table
        for ($i = 0; $i < $columnCount; $i ++) {
        while ($row = mysqli_fetch_row($result)) {
            $sqlScript .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $columnCount; $j ++) {
                $row[$j] = $row[$j];
                
                if (isset($row[$j])) {
                    $sqlScript .= '"' . $row[$j] . '"';
                } else {
                    $sqlScript .= '""';
                }
                if ($j < ($columnCount - 1)) {
                    $sqlScript .= ',';
                }
            }
            $sqlScript .= ");\n";
        }
        }
        
        $sqlScript .= "\n"; 
        }
        
        if(!empty($sqlScript))
        {
        
        // Save the SQL script to a backup file
        $backup_file_name = 'db_backup/'.$database_name .'_backup_'.date("l_F_dS_Y").'.sql';
        $fileHandler = fopen($backup_file_name, 'w+');
        $number_of_lines = fwrite($fileHandler, $sqlScript);
        fclose($fileHandler); 
        if ($number_of_lines) {
        // display a sucess message
        return redirect()->route('admin.backup')->with(['success' => 'تم أخذ النسخة الأحتياطية بنجاح بتارخ اليوم فى ملف db_backup']);
        }
        
        }
        
        }
                                 
    }
    
    public function backUpTwo()
    {
        $connect = new PDO("mysql:host=127.0.0.1;dbname=vetopetocare", "vetopetocare", "24846912");
        if(isset($_POST['table']))
        {
         $output = '';
         foreach($_POST["table"] as $table)
         {
          $show_table_query = "SHOW CREATE TABLE " . $table . "";
          $statement = $connect->prepare($show_table_query);
          $statement->execute();
          $show_table_result = $statement->fetchAll();
        
          foreach($show_table_result as $show_table_row)
          {
           $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
          }
          $select_query = "SELECT * FROM " . $table . "";
          $statement = $connect->prepare($select_query);
          $statement->execute();
          $total_row = $statement->rowCount();
        
          for($count=0; $count<$total_row; $count++)
          {
           $single_result = $statement->fetch(PDO::FETCH_ASSOC);
           $table_column_array = array_keys($single_result);
           $table_value_array = array_values($single_result);
           $output .= "\nINSERT INTO $table (";
           $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
           $output .= "'" . implode("','", $table_value_array) . "');\n";
          }
         }
         $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
         $file_handle = fopen($file_name, 'w+');
         fwrite($file_handle, $output);
         fclose($file_handle);
         header('Content-Description: File Transfer');
         header('Content-Type: application/octet-stream');
         header('Content-Disposition: attachment; filename=' . basename($file_name));
         header('Content-Transfer-Encoding: binary');
         header('Expires: 0');
         header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_name));
            ob_clean();
            flush();
            readfile($file_name);
            unlink($file_name);
        }
    }
    
}