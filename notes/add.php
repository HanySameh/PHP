<?php

include "../connect.php";

$title       = filterRequest("title");
$content     = filterRequest("content");
$userid      = filterRequest("id");

$imagename = imageUpload("file");

if ($imagename != 'fail') {

    $stmt = $con->prepare("INSERT INTO `notes`
    (`note_title`, `note_content`,`note_user` , `note_image`)
  VALUES (? , ?  , ? , ?)
  ");

    $stmt->execute(array($title, $content, $userid, $imagename));

    $count = $stmt->rowCount();

    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "fail"));
    }
} else {
    echo json_encode(array("status" => "fail"));
}
