<?php
 class ITFExport
 {
   private $exportdata;
   
   function __construct($exportdata) {
       $this->exportdata=$exportdata;
   } 
     
   function cleanData(&$str) { 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) 
                $str = '"' . str_replace('"', '""', $str) . '"';
    }
    
    function download($alldata=array()) {
        $filename = "website_data_" . date('Ymd') . ".xls"; 
        header("Content-Disposition: attachment; filename=\"$filename\""); 
        header("Content-Type: application/vnd.ms-excel");
        $flag = false; 
        foreach($this->exportdata as $row) 
         { 
           if(!$flag) 
               {
               echo implode("\t", array_keys($row)) . "\r\n"; 
               $flag = true; 
               } 
               array_walk($row, array($this,'cleanData')); 
               echo implode("\t", array_values($row)) . "\r\n"; 
         }
         exit();
    }
 }
?>
