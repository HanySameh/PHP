<?php

include "../connect.php";

$noteid         =   filterRequest("id");
$title          =   filterRequest("title");
$content        =   filterRequest("content");
$imagename      =   filterRequest("imagename");

if (isset($_FILES['file'])) {

    deleteFile("../upload", $imagename);
    $imagename = imageUpload("file");
}


$stmt = $con->prepare("UPDATE `notes` SET 
 `note_title`=?,`note_content`=? , note_image = ?   WHERE id = ?
");
$stmt->execute(array($title, $content, $imagename, $noteid));
$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}
