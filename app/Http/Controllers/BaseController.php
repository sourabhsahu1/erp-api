<?php
/**
 * Created by PhpStorm.
 * User: choxx
 * Date: 1/5/19
 * Time: 2:45 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Luezoid\Laravelcore\Constants\ErrorConstants;
use Luezoid\Laravelcore\Http\Controllers\ApiController;
use Luezoid\Laravelcore\Services\UtilityService;

class BaseController extends ApiController
{
    public $loadEnv = true;

    public function getLoggedInUser()
    {
        return auth('api')->user();
    }

    public function getLoggedInUserId()
    {
        $user = $this->getLoggedInUser();
        return !is_null($user) ? $user->id : null;
    }

    public function getUserByToken()
    {
        $user = Auth::user();
        if (!$user) {
            return $this->standardResponse(null, "user not found", 403);
        }
        return $user;
    }

    protected function executeJob($request, $job, $params)
    {
        if ($this->loadEnv) {
            $params['data']['user_id'] = $this->getLoggedInUserId();
        }
        return parent::executeJob($request, $job, $params);
    }

    public function standardResponse($data, $message = null, $httpCode = 200, $type = null)
    {

        if ($httpCode == 200 && $data && $this->isSnakeToCamel) {
            $data = UtilityService::fromSnakeToCamel(json_decode(json_encode($data), true));
        }

        $data = $data && method_exists($data, 'toArray') ? $data->toArray() : $data;
        return response()->json([
            "message" => $message,
            "data" => request('stringify') ? json_encode($data) : $data,
            "type" => $type
        ], $httpCode);
    }

    public function removeDefaultMessage()
    {
        $this->customMessage = "";
        $this->defaultMessage = "";
    }

    /**
     * @param $job
     * @param null $request
     * @param null $additionalData
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function handleCustomEndPoint($job, $request = null, $additionalData = null)
    {
        if ($this->customRequest && $response = $this->validateRequest($this->customRequest)) return $response;
        $data = [];
        if ($request) {
            $requestData = array_replace_recursive(
                $request->json()->all(),
                $request->route()->parameters()
            );
            $data = UtilityService::fromCamelToSnake($requestData);
        }
        return $this->executeJob($request, $job, [
            'data' => $data,
            'additionalData' => $additionalData
        ]);
    }


    /**
     * @param $job
     * @param null $request
     * @param array $additionalData
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleCustomEndPointGet($job, $request, $additionalData = [])
    {

        if ($this->customRequest && $response = $this->validateRequest($this->customRequest)) return $response;
        $inputs = [];
        $userId = null;
        if ($request) {
            $userId = $this->getLoggedInUserId();

            $inputs = array_replace_recursive(
                $request->all(),
                $request->route()->parameters()
            );
        }

        if ($this->isCamelToSnake) {
            $inputs = UtilityService::fromCamelToSnake($inputs);
        }
        return $this->executeJob($request, $job, ["with" => $this->indexWith, "inputs" => $inputs, "user_id" => $userId, "additionalData" => $additionalData]
        );
    }

    /**
     * global index function . return all data of Specific Model.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $userId = $this->getLoggedInUserId();

        $inputs = array_replace_recursive(
            $request->all(),
            $request->route()->parameters()
        );
        if ($this->isCamelToSnake) {
            $inputs = UtilityService::fromCamelToSnake($inputs);
        }

        $result = $this->repo->{$this->indexCall}(["with" => $this->indexWith, "inputs" => $inputs, "user_id" => $userId]);
        return $this->standardResponse($result);

    }




}
