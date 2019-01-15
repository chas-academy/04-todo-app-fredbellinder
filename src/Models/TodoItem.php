<?php

namespace Todo;

class TodoItem extends Model
{
    const TABLENAME = 'todos'; // This is used by the abstract model, don't touch

    public static function createTodo($title)
    {
        $query = "INSERT INTO " . static::TABLENAME . "(title, created) " . "VALUES ('$title', " . CURRENT_TIMESTAMP . ")";
        self::$db->query($query);
        $result = self::$db->execute($query);
        return $result;
    }

    public static function updateTodo($todoId, $title, $completed = null)
    {
        $query = "UPDATE " . static::TABLENAME . " SET title = :title, completed = :completed, updated = " . CURRENT_TIMESTAMP . " WHERE id = :id";

        self::$db->query($query);
        self::$db->bind(':id', $todoId);
        self::$db->bind(':title', $title);
        self::$db->bind(':completed', $completed);
        $result = self::$db->execute();
        return $result;
    }


    public static function deleteTodo($todoId)
    {
        $query = "DELETE FROM " . static::TABLENAME . " WHERE id ='$todoId'";
        self::$db->query($query);
        $result = self::$db->execute($query);
        return $result;
    }
    
    // (Optional bonus methods below)
    // public static function toggleTodos($completed)
    // {
    //     // TODO: Implement me!
    //     // This is to toggle all todos either as completed or not completed
    // }

    // public static function clearCompletedTodos()
    // {
    //     // TODO: Implement me!
    //     // This is to delete all the completed todos from the database
    // }
}
