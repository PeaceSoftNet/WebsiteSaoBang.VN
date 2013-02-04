<?php

/*
 * Uploadify
 * Copyright (c) 2012 Reactive Apps, Ronnie Garcia
 * Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
 * edit by thiendd@peacesoft.net
 */

// Define a destination

$targetFolder = '/data/images'; // Relative to the root

if (!empty($_FILES)) {
    $item = (int) date('H') . date('i') . date('s');
    $folderName = $item % 200 + 1;
    /**
     * check and create folder 
     */
    if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $folderName)) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $folderName, 0777);
    }

    $targetFolder = $targetFolder . '/' . $folderName;

    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

    $fileName = $item . '-' . $_FILES['Filedata']['name'];


    // Validate the file type
    $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
    $fileParts = pathinfo($fileName);
    
    $targetFile = rtrim($targetPath, '/') . '/img' . time() . 'saobangvn.' . $fileParts['extension'];
    
    if (in_array($fileParts['extension'], $fileTypes)) {
        move_uploaded_file($tempFile, $targetFile);
        echo $targetFolder . '/img' . time() . 'saobangvn.' . $fileParts['extension'];
    } else {
        echo 'Invalid file type.';
    }
}