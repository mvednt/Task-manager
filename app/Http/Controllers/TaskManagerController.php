<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TaskResponseHelper;
use App\Services\TaskManagerService;

class TaskManagerController extends Controller
{

    function __construct(TaskResponseHelper $responseHelper, TaskManagerService $taskManagerService)
    {
        $this->taskManagerService = $taskManagerService;
        $this->responseHelper = $responseHelper;
    }

    public function createTask(Request $request){
        $validation = $this->responseHelper->api_validate_request($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validation !== true) {
            return $validation;
        }

        return $this->taskManagerService->createTask($request->all());
    }

    public function updateTask(Request $request, $id){
        $validation = $this->responseHelper->api_validate_request($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validation !== true) {
            return $validation;
        }

        return $this->taskManagerService->updateTask($request->all(), $id);
    }

}
 