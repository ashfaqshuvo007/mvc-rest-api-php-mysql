<?php

require PROJECT_ROOT_PATH . "/Controller/ShiftController.php";

function GetControllerInstance($controller)
{
    try {
        switch ($controller) {
            case "user":
                return new ShiftController();                
            default:
                header("HTTP/1.1 404 Not Found");
                exit();
                break;
        }
    } catch (Error $e) {
        sendError(array('error' => $e->getMessage()));
    }
    return null;
}