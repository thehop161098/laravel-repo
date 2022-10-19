<?php

namespace App\Traits\Responses;

use App\Exceptions\CustomException;
use App\Exceptions\ErrorCode;
use App\Exceptions\InvalidException;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

trait ApiResponse
{
    public function response($data, $success = true, $status = 200)
    {

        if(is_object($data) && !is_array($data) && !($data instanceof ResourceCollection)  && !($data instanceof JsonResource)){
            if(method_exists($data,'toArray'))
                $data = $data->toArray();
        }
        if (isset($data['first_page_url'])) {
            unset($data['first_page_url']);
        }
        if (isset($data['last_page_url'])) {
            unset($data['last_page_url']);
        }
        if (isset($data['next_page_url'])) {
            unset($data['next_page_url']);
        }
        if (isset($data['path'])) {
            unset($data['path']);
        }
        if (isset($data['prev_page_url'])) {
            unset($data['prev_page_url']);
        }
        return response()->json([
            'success' => $success,
            'data'    => $data,
        ], $status);
    }

    public function successResponse($data)
    {
        return $this->response($data);
    }

    public function failedResponse($message = 'Invalid input data.', $extraData = [])
    {
        throw new InvalidException(
            $message,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            null,
            ErrorCode::VALIDATION_ERROR,
            $extraData
        );
    }

    public function errorResponse($message = 'Server Error. Please contact technical for supporting.', $extraData = [])
    {
        throw new CustomException(
            $message,
            Response::HTTP_INTERNAL_SERVER_ERROR,
            null,
            ErrorCode::SERVER_ERROR,
            $extraData
        );
    }

    public function unauthorizedResponse(
        $message,
        $errorCode = ResponseErrorCode::UNAUTHORIZED,
        $httpCode = Response::HTTP_UNAUTHORIZED
    ) {
        return $this->response([
            'success'    => false,
            'error_code' => $errorCode,
            'message'    => $message,
        ], $httpCode);
    }
}
