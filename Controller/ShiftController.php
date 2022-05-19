<?php
require PROJECT_ROOT_PATH . "/DataAccess/ShiftLayer.php";

class ShiftController
{
    /* GET "/shift/all" Endpoint to get all shifts */
    public function shiftAllAction($data)
    { 
        try {
            $shiftObj = new ShiftLayer();
            $responseData = $shiftObj->getAllShifts($data);
            sendSuccess($responseData);
        } catch (Error $e) { 
            sendError(array('error' => $e->getMessage()));
        }
    }

    /* POST "/shift/create" Endpoint to save shifts */
    public function shiftPostAction($data)
    { 
        try {
            $shiftObj = new ShiftLayer();
            $responseData = $shiftObj->createShift($data);
            sendSuccess($responseData); 
        } catch (Error $e) {
            sendError(array('error' => $e->getMessage()));
        }
    }

    /* DELETE "/shift/delete" Endpoint to delete shift */
    public function shiftDeleteAction($data)
    {
        try {
            $shiftObj = new ShiftLayer();
            $responseData = $shiftObj->deleteShift($data);
            sendSuccess($responseData);
        } catch (Error $e) {
           sendError(array('error' => $e->getMessage()));
        } 
    }
}