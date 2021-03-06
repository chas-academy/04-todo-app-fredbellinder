<?php

namespace Todo;

class TodoItem extends Model
{
    const TABLENAME = 'todos'; // This is used by the abstract model, don't touch

    public static function createTodo($title)
    {
        $query = "INSERT INTO " . static::TABLENAME . "(title, created) " . "VALUES (:title, " . CURRENT_TIMESTAMP . ")";
        self::$db->query($query);
        self::$db->bind(':title', $title);
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
        $query = "DELETE FROM " . static::TABLENAME . " WHERE id = :id";
        self::$db->query($query);
        self::$db->bind(':id', $todoId);
        $result = self::$db->execute($query);
        return $result;
    }
    
    // (Optional bonus methods below)
    public static function toggleTodos($toggled)
    {
        $query = "UPDATE " . static::TABLENAME ." SET completed = :completed";
        self::$db->query($query);
        self::$db->bind(':completed', $toggled);
        $result = self::$db->execute();
        return $result;
    }

    public static function clearCompletedTodos()
    {
        $query = "DELETE FROM " . static::TABLENAME . " WHERE completed = 'true'";
        self::$db->query($query);
        $result = self::$db->execute();
        return $result;
    }

    public static function showOnly($completed1, $completed2)
    {
        $query = "SELECT * FROM " . static::TABLENAME . " WHERE completed = :completed1 OR completed = :completed2 ORDER BY created DESC";
        self::$db->query($query);
        self::$db->bind(':completed1', $completed1);
        self::$db->bind(':completed2', $completed2);
        $results = self::$db->resultset();
        if (!empty($results)) {
            return $results;
        } else {
            return [];
        }
    }
}
