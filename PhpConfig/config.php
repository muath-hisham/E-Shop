<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "abdo";
$conn = mysqli_connect($host, $user, $password, $dbName);

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$products = [];
session_start();

// Function to insert an item into the global array
function insertItem($value)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $_SESSION['cart'][] = $value;
}

// Function to remove an item from the global array
function removeItem($key)
{
    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$key])) {
        // Remove the item from the global array
        unset($_SESSION['cart'][$key]);
    }
}
