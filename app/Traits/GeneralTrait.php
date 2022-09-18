<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\Pure;

trait GeneralTrait
{
    public function returnError($msg = "Error", $errNum = 501): JsonResponse
    {
        return response()->json([
            'status' => false,
            'code' => $errNum,
            'msg' => $msg
        ], $errNum);
    }

    public function returnSuccessMessage($msg = "Success", $errNum = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => $errNum,
            'msg' => $msg
        ], $errNum);
    }

    public function returnData($msg, $value, $key = "data", $errNum = 200,): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => $errNum,
            'msg' => $msg,
            $key => $value
        ], $errNum);
    }
}
