<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    /**
     @test
     */
    // public function test_index_todo_list()
    // {
    //     // preperation / Prepare

    //     // Action / Perform
    //     $response = $this->getJson(route('todo-list.index'));
    //     // dd($response->json());

    //     // Assertion / Predict
    //     $this->assertEquals(1, count($response->json()));
    // }

    public function test_fecth_all_todo_list()
    {
        // preperation / Prepare
        TodoList::factory()->create(['name' => 'My First']);

        // Action / Perform
        $response = $this->getJson(route('todo-list.index'));
        // dd($response->json());

        // Assertion / Predict
        $this->assertEquals(1, count($response->json()));
        $this->assertEquals('My First', $response->json()[0]['name']);

    }

    public function test_fect_single_todo_list()
    {
        $list = TodoList::factory()->create();

        $response = $this->getJson(route('todo-list.show',$list->id))
                        ->assertOk();
        $this->assertEquals($response->json()['name'], $list->name);
    }
}
