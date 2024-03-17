<?php
    include_once('class/DeviceManager.php');
    // connect data MySQL
    $deviceManager = new DeviceManager();
    $conn = $deviceManager->connectData("localhost:3307", "banphimco", "Manh0385@", "banphimco");
?>