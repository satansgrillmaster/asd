<?php

function dirToArray($dir) {

    $result = array();
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
        if (!in_array($value,array(".","..")))
        {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
            {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            }
            else
            {
                $result[] = $value;
            }
        }
    }
    return $result;
}

function delete_gallery(){
    if(isset($_POST['delete'])){
        unlink('images/' . $_POST['delete_value']);
    }
}

function create_thumbnails($path){
    echo $path;
    $img = imagecreatefromjpeg($path);

    $width = imagesx($img);
    $height = imagesy($img);

    $new_width = 30;
    $new_height = 30;

    $new_img = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new_img,$img,0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagejpeg($new_img, $path);
}

function print_upload(){
    if(isset($_FILES['upload_img'])){
        $path = './images/' . $_FILES['upload_img']['name'];
        move_uploaded_file($_FILES['upload_img']['tmp_name'],$path);
        create_thumbnails($path);
    }
    echo '<form method="post" action="index.php" accept-charset="utf-8" id="upload_form" enctype="multipart/form-data">';
    echo '<h3>Lade deinen Hund hoch</h3>';
    echo '<input type="file" id="a" name="upload_img">';
    echo '<input type="submit" name="upload">';
    echo '</form>';
}

function print_gallery(){
    foreach(dirToArray('./images') as $img){

        echo '<form method="post" action="index.php" accept-charset="utf-8">';
        echo '<a href="./images/'.$img.'"><img src="images/'. $img . '" alt = "'.$img.'"></a>';
        echo '<input type="hidden" value="'.$img.'" name="delete_value">';
        echo '<input type="submit" value="Delete" name="delete" class="delete_img">';
        echo '<p>Name: ' . str_replace(".jpg","",$img) . '</p>';
        echo '</form>';
    }
}

echo '<!DOCTYPE html>
            <html lang="de">
            <head>
                <meta charset="UTF-8">
                <title>BilderGallery</title>
                <link href="style.css" rel="stylesheet">
            </head>
            <body>
            <div class="container">
            <h1>Hunde Galerie</h1>';

delete_gallery();
print_upload();
print_gallery();

echo '</body></html>';
?>