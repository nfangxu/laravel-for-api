<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class ApiExceptionHandle extends Exception
{
    use ApiResponse;

    /**
     * @var Exception
     */
    public $exception;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    protected $report;

    /**
     * ExceptionReport constructor.
     * @param Request $request
     * @param Exception $exception
     */
    function __construct(Request $request, Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
    }

    /**
     * @var array
     */
    public $doReport = [
        AuthenticationException::class => ['未授权', 401],
    ];

    /**
     * @return bool
     */
    public function shouldReturn()
    {

        if (!($this->request->wantsJson() || $this->request->ajax())) {
            return false;
        }

        foreach (array_keys($this->doReport) as $report) {
            if ($this->exception instanceof $report) {
                $this->report = $report;
                return true;
            }
        }

        return false;
    }

    /**
     * @param Request  $request     
     * @param Exception $e
     * @return static
     */
    public static function make(Request $request, Exception $e)
    {
        return new static($request, $e);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function report()
    {
        $message = $this->doReport[$this->report];

        return $this->failed($message[0], $message[1]);
    }
}
