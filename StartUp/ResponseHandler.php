<?php

// Send API response.
function sendResponse($data, $httpHeaders = array())
{
    ob_clean(); 
    header_remove('Set-Cookie');

    if (is_array($httpHeaders) && count($httpHeaders)) {
        foreach ($httpHeaders as $httpHeader) {
            header($httpHeader);
        }
    }

    echo $data;
    exit;
}

function sendSuccess($data)
{
    sendResponse(
        json_encode($data),
        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
    );
}

function sendError($data)
{
    sendResponse(
        json_encode($data),
        array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error')
    );
} 