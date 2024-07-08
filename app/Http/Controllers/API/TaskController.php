<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskFormRequest;
use App\Services\Task\TaskServiceInterface;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    protected $taskService;

    /**
     * TaskController constructor.
     *
     * @param TaskServiceInterface $taskService
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of tasks.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->taskService->getAllTasks());
    }

    /**
     * Store a newly created task.
     *
     * @param TaskFormRequest $request
     * @return JsonResponse
     */
    public function store(TaskFormRequest $request): JsonResponse
    {
        $task = $this->taskService->createTask($request->validated());
        return response()->json($task, 201);
    }

    /**
     * Display the specified task.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $task = $this->taskService->getTaskById($id);
        return response()->json($task);
    }

    /**
     * Update the specified task.
     *
     * @param TaskFormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TaskFormRequest $request, $id): JsonResponse
    {
        $task = $this->taskService->updateTask($id, $request->validated());
        return response()->json($task, 200);
    }

    /**
     * Remove the specified task.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->taskService->deleteTask($id);
        return response()->json(null, 204);
    }
}
