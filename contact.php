<?php

$cleanedGetData = array_map(function ($getData) {
    return trim($getData);
}, $_GET);

function isValueSet($v): bool
{
    return isset($v);
}

function isValueEmpty($v): bool
{
    return empty($v) || trim($v) === "";
}

function isValueEmail($v)
{
    return filter_var($v, FILTER_VALIDATE_EMAIL);
}

if (!isValueSet($cleanedGetData["email"]) || !isValueSet($cleanedGetData["name"]) || isValueEmpty($cleanedGetData["email"]) || isValueEmpty($cleanedGetData["name"]))
{
    echo "You must provide a name and an email address";
    return;
} elseif (!isValueEmail($cleanedGetData["email"]))
{
    echo "Your email is not an email";
    return;
}

echo "Welcome " . $cleanedGetData["name"] . ", your email is " . $cleanedGetData["email"];
