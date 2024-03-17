<?php
    class DeviceManager {
        public function connectData($serverName,$username,$password,$database) {
            $conn = mysqli_connect($serverName,$username,$password,$database);
            // check connect
            if(!$conn) {
                echo"Could not connect to server: " . $conn->connect_error;
                exit();
            }
            return $conn;
            echo "<script>alert('Connected to server');</script>";
        }
        // public function disconnectData($conn){
        //     mysqli_disconnect($conn);
        // }
    }
?>