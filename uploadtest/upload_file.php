<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$targetFolder = 'data/images'; // Relative to the root
var_dump($_FILES);
echo '<br />';
if (!empty($_FILES)) {
    $item = (int) date('H') . date('i') . date('s');
    $folderName = $item % 200 + 1;
    /**
     * check and create folder 
     */
    if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $folderName)) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $folderName, 0777);
    }

    echo $_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $folderName;
    echo '<hr />';
    $targetFolder = $targetFolder . '/' . $folderName;

    $tempFile = $_FILES['Filedata']['tmp_name'];
    
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
    $fileName = $item . '-' . urlencode($_FILES['Filedata']['name']);

    $targetFile = rtrim($targetPath, '/') . '/' . $fileName;

    // Validate the file type
    $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
    $fileParts = pathinfo($fileName);

    if (in_array($fileParts['extension'], $fileTypes)) {
        move_uploaded_file($tempFile, $targetFile);
        echo $targetFolder . '/' . $fileName;
    } else {
        echo 'Invalid file type.';
    }
}