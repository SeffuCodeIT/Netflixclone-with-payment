<?php

    
  

       $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
       $cleardb_server = $cleardb_url["localhost"];
       $cleardb_username = $cleardb_url["root"];
       $cleardb_password = $cleardb_url["seffu"];
       $cleardb_db = substr($cleardb_url["netflix"], 1);
       $active_group = 'default';
       $query_builder = TRUE;
        
         

     
        
        try {
                $conn = new PDO("mysql:host=$cleardb_server;dbname=$cleardb_db", $cleardb_username, $cleardb_password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connected successfully";
              } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
              }
        

?>