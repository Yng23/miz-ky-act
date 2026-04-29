<?php
require 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$id])) {
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting student!";
}
?>
