<?php
$ProductID = $_GET['ProductID'];
$sql = "DELETE FROM news where ProductID = $ProductID";
$query = mysqli_query($connect, $sql);
header('location: QLBaiViet-admin.php?page_layout=danhsach.php');

if (isset($_POST['remove'])) {
    $key=array_search($_GET['name'],$_SESSION['name']);
    if($key!==false)
    unset($_SESSION['name'][$key]);
    $_SESSION["name"] = array_values($_SESSION["name"]);
} 

?>