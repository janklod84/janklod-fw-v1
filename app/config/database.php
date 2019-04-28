<?php 

return [
     
     /*
      |------------------------------------------------------------------
      |   Database DSN 
      |------------------------------------------------------------------
     */
     
     'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=basic;charset=utf8',

      
     /*
      |------------------------------------------------------------------
      |   Database Username
      |------------------------------------------------------------------
     */
      'user' => 'admin', // 'root',

     /*
      |------------------------------------------------------------------
      |   Database Password
      |------------------------------------------------------------------
     */
      'password' => '123', // '', 

     /*
      |------------------------------------------------------------------
      |  Options Settings
      |------------------------------------------------------------------
     */
      'options' => [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
      ], 

      /*
      |------------------------------------------------------------------
      |   Prefix Table 
      |------------------------------------------------------------------
     */
      'prefix_table' => 'tbl_',


      /*
      |------------------------------------------------------------------
      |   Collation
      |------------------------------------------------------------------
     */
      'collation' => 'utf8mb4',


     /*
      |------------------------------------------------------------------
      |   Moteur Engine
      |------------------------------------------------------------------
     */
      'engine' => 'innoDB' // innoDB, MySIAM

];