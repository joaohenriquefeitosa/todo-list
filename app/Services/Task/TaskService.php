<?php

namespace App\Services\Task;

use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TaskService implements TaskServiceInterface
{
    /**
     * Retrieve all tasks.
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getAllTasks()
    {
        try {
            return Task::all()->toArray();
        } catch (Exception $e) {
            Log::error('Error retrieving tasks: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to retrieve tasks'], 500)->getData(true);
        }
    }

    /**
     * Retrieve a specific task by its ID.
     *
     * @param int $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getTaskById($id)
    {
        try {
            return Task::findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404)->getData(true);
        } catch (Exception $e) {
            Log::error('Error retrieving task: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to retrieve task'], 500)->getData(true);
        }
    }

    /**
     * Create a new task.
     *
     * @param array $data
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function createTask(array $data)
    {
        try {
            return Task::create($data)->toArray();
        } catch (Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create task'], 500)->getData(true);
        }
    }

    /**
     * Update an existing task.
     *
     * @param int $id
     * @param array $data
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function updateTask($id, array $data)
    {
        try {
            $task = Task::findOrFail($id);
            $task->update($data);
            return $task->toArray();
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404)->getData(true);
        } catch (Exception $e) {
            Log::error('Error updating task: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update task'], 500)->getData(true);
        }
    }

    /**
     * Delete a specific task.
     *
     * @param int $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function deleteTask($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return ['message' => 'Task deleted successfully'];
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404)->getData(true);
        } catch (Exception $e) {
            Log::error('Error deleting task: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete task'], 500)->getData(true);
        }
    }
}
