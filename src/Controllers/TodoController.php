<?php

use Todo\Controller;
use Todo\Database;
use Todo\TodoItem;

class TodoController extends Controller
{
    public function get()
    {
        $todos = TodoItem::findAll();
        return $this->view('index', ['todos' => $todos]);
    }

    public function add()
    {
        $body = filter_body();
        if (trim($body['title']) != null) {
            $result = TodoItem::createTodo($body['title']);
        }

        if ($result) {
            $this->redirect('/');
        } else { // result KOMMER att vara false om titel-inputt är null
            $this->redirect('/');
        }
    }

    public function update($urlParams)
    {
        $body = filter_body(); // gives you the body of the request (the "envelope" contents)
        $todoId = $urlParams['id']; // the id of the todo we're trying to update
        $completed = isset($body['status']) ? 'true' : 'false'; // whether or not the todo has been checked or not

        $result = TodoItem::updateTodo($todoId, $body['title'], $completed);
        if ($result) {
            $this->redirect('/');
        }
        // TODO: Implement me!
        // This action should update a specific todo item in the todos table using the TodoItem::updateTodo method.
        // Try and figure out what parameters you need to pass to the updateTodo-method in the TodoItem model.

        // if there's a result
          // use the redirect method to send the user back to the list of todos $this->redirect('/');
        // otherwise, throw an exception or show an error message
    }

    public function delete($urlParams)
    {
        $result = ToDoItem::deleteTodo($urlParams['id']);
        if ($result) {
            $this->redirect('/');
        }
    }

    /**
     * OPTIONAL Bonus round!
     *
     * The two methods below are optional, feel free to try and complete them
     * if you're aiming for a higher grade.
     */
    public function toggle()
    {
        $body = TodoItem::findAll();

        $toggleToThis = '';
        $falseCount = count(
            array_filter(
                $body,
                function ($body) {
                    return $body['completed'] === 'false';
                }
            )
        );
        if ($falseCount == 0) {
            $toggleToThis = 'false';
        } else {
            $toggleToThis = 'true';
        }
        $result = TodoItem::toggleTodos($toggleToThis);
        if ($result) {
            $this->redirect('/');
        } else {
            $this->redirect('/');
        }
        // (OPTIONAL) TODO: This action should toggle all todos to completed, or not completed.
    }

    public function clear()
    {
        $result = TodoItem::clearCompletedTodos();
        if ($result) {
            $this->redirect('/');
        }
    }

    public function show()
    {
        $body = filter_body();
        $completed;
        if (isset($body['inactive'])) {
            $completed = 'true';
            $todos = TodoItem::showOnly($completed, $completed);
        } elseif (isset($body['active'])) {
            $completed = 'false';
            $todos = TodoItem::showOnly($completed, $completed);
        } elseif (isset($body['all'])) {
            $completed1 = 'false';
            $completed2 = 'true';
            $todos = TodoItem::showOnly($completed1, $completed2);
        }
        
        // if ($todos) {
        //     $this->redirect('/');
        // } else {
        //     $this->redirect('/');
        // }
        return $this->view('index', ['todos' => $todos]);
    }
}
