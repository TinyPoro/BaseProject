<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\TestServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    private $testService;

    public function __construct(
        TestServiceInterface $testService
    ) {
        $this->testService = $testService;
    }

    public function test(Request $request)
    {
        try {
            $params = $request->all();

            $validator = Validator::make($params, [
                'test' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => [
                        'internalMessage' => $validator->errors(),
                        'error_code' => 400,
                        'success' => false,
                    ],
                ], 400);
            }

            $post = $this->testService->test();

            return response()->json([
                'message' => [
                    'internalMessage' => 'Test successfully',
                    'error_code' => 200,
                    'success' => true,
                ],
                'data' => $post,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => [
                    'internalMessage' => $e->getMessage(),
                    'error_code' => 500,
                    'success' => false,
                ]
            ], 500);
        }
    }
}
