<?php

namespace App\Services;

use App\Helpers\TaskResponseHelper;
use App\Models\Task;

class TaskManagerService {

    function __construct(TaskResponseHelper $responseHelper)
    {
        $this->responseHelper = $responseHelper;
    }

    public function createTask($request){
        $task = new Task();
        $task->title = $request['title'];
        $task->description = $request['description'];
        $task->save();

        return $this->responseHelper->api_response($task, 200, "success", "Task created successfully.");
    }

    public function updateTask($request, $id){
        
        $task = Task::find($id);
        if(!$task){
            return $this->responseHelper->api_response(null, 422, "error", "Task not found.");
        }
        $task->title = $request['title'];
        $task->description = $request['description'];
        $task->save();
        return $this->responseHelper->api_response($task, 200, "success", "Task updated successfully.");
    }
}
