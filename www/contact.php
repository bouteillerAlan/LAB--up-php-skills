<?php

$_MAXFILESIZE = 1000000;
$_FILEEXTALLOWED = ["jpg", "jpeg", "gif", "png"];
$_FILESTORAGEPATH = __DIR__ . "/uploads/";

// cleaning up the data before anything else
// I used strip_tag, but we totally can use htmlspecialchars
$cleanedGetData = array_map(function ($getData) {
    return strip_tags(trim($getData));
}, $_POST);

/**http://localhost:8000/contact.php
 * test if a value is set with isset
 * @param $v
 * @return bool true if the value is set
 */
function isValueSet($v): bool
{
    return isset($v);
}

/**
 * test if a value is empty with empty() and equal ""
 * @param $v
 * @return bool true if the value is empty
 */
function isValueEmpty($v): bool
{
    return empty($v) || trim($v) === "";
}

/**
 * test if a value is an email, no trim is apply
 * @param $v
 * @return mixed
 */
function isValueEmail($v): mixed
{
    return filter_var($v, FILTER_VALIDATE_EMAIL);
}

// we need value to proceed
if (!isValueSet($cleanedGetData["email"]) || !isValueSet($cleanedGetData["name"]) || isValueEmpty($cleanedGetData["email"]) || isValueEmpty($cleanedGetData["name"]))
{
    echo "You must provide a name and an email address";
    return;
}
// we need a right formated email to proceed
elseif (!isValueEmail($cleanedGetData["email"]))
{
    echo "Your email is not an email";
    return;
}

// if everything is ok
echo "Welcome " . $cleanedGetData["name"] . ", your email is " . $cleanedGetData["email"];

// check the data
if (!isValueSet($_FILES["file"]) || $_FILES["file"]["error"] !== 0)
{
    echo "The file upload have encounter a problem (error code: {$_FILES["file"]["error"]})";
    return;
}

// check the size
if ($_FILES["file"]["size"] > $_MAXFILESIZE)
{
    echo "The file is too heavy, you need to send a smaller file (less than " . $_MAXFILESIZE / 1000000 . "Mo)";
    return;
}

// checking the extension
$fileInfos = pathinfo($_FILES["file"]["name"]);
if (!array_search($fileInfos["extension"], $_FILEEXTALLOWED))
{
    echo "The file is not on the right format (" . implode(", ", $_FILEEXTALLOWED) . ")";
    return;
}

// check if the storage file exist
if (!is_dir($_FILESTORAGEPATH))
{
    echo "Hu ho we have encountered a problem on the server, contact the support!";
    return;
}

// if everything is good let's store it
$uploadDate = new DateTime();
$uploadDateFormated = $uploadDate->format(DATE_W3C);
move_uploaded_file($_FILES["file"]["tmp_name"], $_FILESTORAGEPATH . $uploadDateFormated . "-" . basename($_FILES["file"]["name"]));
