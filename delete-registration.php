<?php require_once('./database/connection.php'); ?>

<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: ./show-registrations.php');
}

$sql = "DELETE FROM `registrations` WHERE `id` = $id";
if($conn->query($sql)) {
    header('location: ./show-registrations.php');
} else {
    echo "Failed to delete!";
}

