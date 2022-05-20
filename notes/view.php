<?php
include "../connect.php";

$userid = $_POST['id'];
$stmt = $con->prepare("SELECT * FROM notes WHERE `note_user`=? ");

$stmt->execute(array($userid));
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "fail"));
}
