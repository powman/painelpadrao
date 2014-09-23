/*
	DB_DEFAULT  // start a mysql driver 
	DB_MYSQL    // start a mysql driver
	DB_POSTGRE  // start postgre driver
	DB_SQLITE   // start sqlite driver

*/

$databaseSetup = new cbSQLConnectConfig( cbSQLConnectVar::DB_MYSQL, "localhost","3306","yourdatabase","root","");  // Setup Class

/*

 FETCH_ASSOC  // all queries return in assoc
 FETCH_LAZY  =  // mix assoc with class
 FETCH_OBJECT = // return as object

*/

$database = new cbSQLConnect(&$databaseSetup, cbSQLConnectVar::FETCH_ASSOC); 

// Simple Query
$data = $database->QuerySingle("SELECT * FROM table");  // data will be populated


Easy Query

$data = $database->Query("SELECT field1, field2 WHERE field1 = :value", array( 
       array(':value' => 1) //retrieve all data
);

//Update

   $database->SQLUpdate("table", "field", "valuetochange", "id","num");
e.g:
   $database->SQLUpdate("table", "field", "valuetochange", "field_id",10);

// Insert

$insert = $database->SQLInsert(array( 
										array( 'field_name' => "value", 
											   'field_id' => "10")
										
										), "table"); // return true if sucess or false


// Delete

 $database->SQLDelete("table", "field_id", "value");  // return true if sucess or false


// get Rows affected

$rows - $database->RowsAffected();

// run last query again

$query = $database->LastQuery;
$database->QuerySingle($query);