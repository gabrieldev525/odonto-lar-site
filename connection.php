<?php
	$my_host = "localhost";
	$my_user = "root";
	$my_password = "";
	$my_db  = "odontolar";

	$conn = mysqli_connect($my_host, $my_user, $my_password) or die("failed to connect!");
    
    //create the database
    $query = "CREATE DATABASE IF NOT EXISTS $my_db;";
    $result = mysqli_query($conn, $query);

    //using the database created
    $conn = mysqli_connect($my_host, $my_user, $my_password, $my_db) or die("failed to connect!");

    //create the table users
    $query = "CREATE TABLE IF NOT EXISTS usuarios(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT," . 
                "name VARCHAR(50) NOT NULL," . 
                "email VARCHAR(100) NOT NULL," . 
				"password VARCHAR(100) NOT NULL," .
				"status VARCHAR(1) NOT NULL);";
	$result = mysqli_query($conn, $query);
	
	//create the table consultas
	$query = "CREATE TABLE IF NOT EXISTS consultas(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT," . 
                "id_usuario INT NOT NULL," . 
                "consulta VARCHAR(30) NOT NULL," . 
				"horario VARCHAR(5) NOT NULL," .
				"dia VARCHAR(2) NOT NULL," .
				"mes VARCHAR(15)," .
				"doutor VARCHAR(8)," .
				"CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id));";
	$result = mysqli_query($conn, $query);
?>