<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
   public function successResponse($message, int $statusCode)
   {
      return response()->json(['status' => true, 'message' => $message, 'status_code' => $statusCode]);
   }

   public function successData($message, $data = [], int $statusCode)
   {
      return response()->json(['status' => true, 'message' => $message, 'status_code' => $statusCode, 'data' => $data]);
   }

   public function errorResponse($message, int $statusCode)
   {
      return response()->json(['status' => false, 'message' => $message, 'status_code' => $statusCode]);
   }

   public function errorData($message, $data = [], int $statusCode)
   {
      return response()->json(['status' => false, 'message' => $message, 'status_code' => $statusCode, 'data' => $data]);
   }

   public function productData($message, $data = [], int $statusCode)
   {
      return response()->json(['status' => true, 'message' => $message, 'status_code' => $statusCode, 'products' => $data]);
   }
}
