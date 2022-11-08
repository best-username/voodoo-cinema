<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as Res;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as Paginator;

class ApiController extends Controller
{

    /**
     * @var int
     */
    protected $statusCode = Res::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return ApiController response
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondCreated($message, $data = null)
    {
        return $this->respond([
                    'status' => 'success',
                    'status_code' => Res::HTTP_CREATED,
                    'message' => $message,
                    'data' => $data
        ]);
    }

    /**
     * @param Paginator $paginate
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination(Paginator $paginate, $data)
    {

        return $this->respond([
                    'status' => 'success',
                    'status_code' => Res::HTTP_OK,
                    'data' => [
                        'data' => $data,
                        'per_page' => $paginate->perPage(),
                        'current_page' => $paginate->currentPage(),
                        'total' => $paginate->total(),
                        'last_page' => $paginate->lastPage(),
                        'next_url' => $paginate->nextPageUrl()
                    ]
        ]);
    }

    protected function respondWithPaginationChat(Paginator $paginate, $data, $room, $muted)
    {

        return $this->respond([
                    'status' => 'success',
                    'status_code' => Res::HTTP_OK,
                    'room_id' => $room,
                    'muted' => $muted,
                    'data' => [
                        'data' => $data,
                        'per_page' => $paginate->perPage(),
                        'current_page' => $paginate->currentPage(),
                        'total' => $paginate->total(),
                        'last_page' => $paginate->lastPage(),
                        'next_url' => $paginate->nextPageUrl(),
                        'prev_url' => $paginate->previousPageUrl()
                    ],
        ]);
    }

    protected function respondWithPagination2(Paginator $paginate, $data, $churn)
    {
        return $this->respond([
                    'status' => 'success',
                    'status_code' => Res::HTTP_OK,
                    'data' => [
                        'data' => $data,
                        'per_page' => $paginate->perPage(),
                        'current_page' => $paginate->currentPage(),
                        'total' => $paginate->total(),
                    ],
                    'churn_rate' => $churn
        ]);
    }

    public function respondNotFound($message = 'Not Found!')
    {
        return $this->respond([
                    'status' => 'error',
                    'status_code' => Res::HTTP_NOT_FOUND,
                    'message' => $message,
        ]);
    }

    public function respondInternalError($message)
    {
        return $this->respond([
                    'status' => 'error',
                    'status_code' => Res::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $message,
        ]);
    }

    public function respondValidationError($message, $errors)
    {
        return $this->respond([
                    'status' => 'error',
                    'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => $message,
                    'data' => $errors
        ]);
    }

    private function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondSuccess($data = null, $message = null)
    {
        return $this->respond([
                    'status' => 'success',
                    'status_code' => Res::HTTP_OK,
                    'message' => $message,
                    'data' => $data
        ]);
    }

    public function respondWithError($message)
    {
        return $this->respond([
                    'status' => 'error',
                    'status_code' => Res::HTTP_UNAUTHORIZED,
                    'message' => $message,
        ]);
    }

}
