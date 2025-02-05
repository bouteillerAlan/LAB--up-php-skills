<?php

// cleaning up the data before anything else
// I used strip_tag, but we totally can use htmlspecialchars
$cleanedGetData = array_map(function ($getData) {
    return strip_tags(trim($getData));
}, $_POST);

/**
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
