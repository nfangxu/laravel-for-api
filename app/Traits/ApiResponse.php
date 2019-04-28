<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response as FoundationResponse;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param array $data
     * @param array $header
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond(array $data, array $header = [])
    {
        return \response()->json($data, $this->getStatusCode(), $header);
    }

    /**
     * @param string $status
     * @param array $data
     * @param null $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(string $status, array $data, $code = null)
    {
        if ($code) {
            $this->setStatusCode($code);
        }

        $status = [
            'status' => $status,
            'code' => $this->statusCode
        ];

        $data = array_merge($status, $data);
        return $this->respond($data);
    }

    /**
     * 常用返回: 请求失败
     *
     * @param string $message
     * @param int $code
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function failed(string $message, int $code = FoundationResponse::HTTP_BAD_REQUEST, string $status = 'error')
    {
        return $this->setStatusCode($code)->message($message, $status);
    }

    /**
     * 常用返回: 请求成功
     *
     * @param array $data
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function success(array $data, $status = "success")
    {
        return $this->status($status, compact('data'));
    }

    /**
     * 常用返回: 返回提示信息
     *
     * @param string $message
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function message(string $message, string $status = "success")
    {

        return $this->status($status, [
            'message' => $message
        ]);
    }

    /**
     * 常用返回: 内部错误
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function internalError(string $message = "内部错误! ")
    {
        return $this->failed($message, FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * 常用返回: 创建成功
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function created(string $message = "创建成功! ")
    {
        return $this->setStatusCode(FoundationResponse::HTTP_CREATED)
            ->message($message);
    }

    /**
     * 常用返回: 内容未找到
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFond($message = '内容未找到! ')
    {
        return $this->failed($message, Foundationresponse::HTTP_NOT_FOUND);
    }
}
