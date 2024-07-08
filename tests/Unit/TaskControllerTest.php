<?php

namespace Tests\Unit\API;

use App\Models\Task;
use App\Services\Task\TaskServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    // use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->seed();
    }

    public function testIndex()
    {
        $response = $this->get('/api/tasks');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $taskData = 'Test Task';

        $data = [
            'title' => $taskData,
            'status' => 'completed',
            'due_date' => '2021-12-31',
            'description' => 'This is a test task',
        ];

        $response = $this->post('/api/tasks', $data);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $task = Task::factory()->create();
        $response = $this->get("/api/tasks/{$task->id}");
        $response->assertStatus(200);
        $response->assertJson(['id' => $task->id]);
    }

    public function testUpdate()
    {
        $task = Task::factory()->create();
        $updatedName = 'Updated Task Name';

        $data = [
            'title' => $updatedName,
            'status' => 'completed',
            'due_date' => '2021-12-31',
            'description' => 'This is a test task',
        ];

        $response = $this->put("/api/tasks/{$task->id}", $data);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $task = Task::factory()->create();
        $response = $this->delete("/api/tasks/{$task->id}");
        $response->assertStatus(204);
    }
}
