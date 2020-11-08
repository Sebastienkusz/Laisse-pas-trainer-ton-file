<?php
if(!empty($_FILES['files']['name'][0])) {
    $files = $_FILES['files'];
    $uploaded = [];
    $errors = [];
    $allowed = ['jpg', 'png', 'gif'];

    foreach ($files['name'] as $fileData => $fileName) {
        $fileTemp = $files['tmp_name'][$fileData];
        $fileSize = $files['size'][$fileData];
        $fileError = $files['error'][$fileData];

        $fileExt = explode('.', $fileName);
        $fileExt = end($fileExt);

        if(in_array($fileExt, $allowed)) {
            if($fileError === 0) {
                if($fileSize <= 1048576) {
                    $fileNewName = uniqid('',true) . '.' . $fileExt;
                    $fileDestination = 'uploads/' . $fileNewName;

                    if(move_uploaded_file($fileTemp, $fileDestination)) {
                        $uploaded[$fileData] = $fileDestination;
                    } else {
                        $errors[$fileData] = "$fileName failed to upload";
                    }
                } else {
                    $errors[$fileData] = "$fileName is too large";
                }
            } else {
                $errors[$fileData] = "$fileName errored with code $fileError";
            }
        } else {
            $errors[$fileData] = "$fileName file extension '$fileExt' is not allowed";
        }
    }
    echo ($errors[$fileData]);
}
header('Location: /upload.php');
?>
