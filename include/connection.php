<?php
$host = "localhost";
$user = 'root';
$password = '';
$dbname = "ecommerce";

// SET DSN (data source name)
try{
$dsn = 'mysql: host='.$host. ';dbname='.$dbname;

// create a pdo instance
$connection = new PDO($dsn, $user, $password);
// echo "Successful";
}catch (PDOExeption $e){
    echo "Connection failed:".$e->getMessage();
}

$create = "CREATE TABLE products (
    -- id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(100) NOT NULL,
    image VARCHAR(100) NOT NULL,
    price INT(11) NOT NULL,
    quantity INT(11) NOT NULL
)";

$connection->exec($create);
    // echo " products table created successfully";

    $create_cart = "CREATE TABLE  cart (
        id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user_id VARCHAR(100) NOT NULL,
        quantity INT(6) NOT NULL

    )";
    
    $connection->exec($create_cart);

    $create_users = "CREATE TABLE users (      
        id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL ,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(100) NOT NULL
       
    )";
    $connection->exec( $create_users);
    

?>