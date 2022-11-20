<?php

    function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bookshop";

        //online connection
        // $servername = "compserverAddress";
        // $username = "studentID";
        // $password = "";
        // $dbname = "bookshop";

        //Create connection


        $conn = new mysqli($servername, $username, $password, $dbname);

        //checks connection
        if ($conn->connect_error) {
            die("Connection failed with error: " . $conn->connect_error);
        } else {
            //TODO if your connection is working correctly, you can comment out this echo
            echo "successful connection";
        }

        return $conn;
    }

