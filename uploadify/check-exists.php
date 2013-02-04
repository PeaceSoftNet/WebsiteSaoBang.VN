<?php

/*
  Uploadify
  Copyright (c) 2012 Reactive Apps, Ronnie Garcia
  Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
 */

// Define a destination
$targetFolder = 'data/images'; // Relative to the root and should match the upload folder in the uploader script

$item = (int) date('H') . date('i') . date('s');

$folderName = $item % 200 + 1;

mkdir($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $folderName, 0777);
/**
 * check and create folder 
 */
if (!is_dir($_SERVER['DOCUMENT_ROOT']. $targetFolder . '/' . $folderName)) {
    mkdir($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $folderName, 0777);
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'])) {
    echo 1;
    echo $_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'];
} else {
    echo 0;
}
?>