<?php

/**
 * List Model Class
 * @author      Ian Herbert <ianpatrickherbert@gmail.com>
 * @version     v.1.0 (09/12/2021)
 */

require_once "tools/PDOTools.php";

class ListModel
{
    private $id;
    private $name;
    private $date;

    // Getters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    // Setters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDate()
    {
        return $this->date;
    }

    // Select all query from the lists table
    public function listAllLists()
    {
        $data = PDOTools::query("SELECT * FROM lists", [], true);

        return $data;
    }

    // create a new list in the database
    public function createList()
    {
        $prepared_sql = "INSERT INTO lists (list_id, name, date ) VALUES (NULL, ?, NOW())";
        $array_values = [$this->name];

        return PDOTools::query($prepared_sql, $array_values, false);
    }

    // Delete list, and its items from the database
    public function deleteList()
    {
        $prepared_sql_items = "DELETE FROM items WHERE list_id = ?";
        $prepared_sql = "DELETE FROM lists WHERE list_id = ?";
        $array_values = [$this->id];
        PDOTools::query($prepared_sql_items, $array_values, false);

        return PDOTools::query($prepared_sql, $array_values, false);
    }

    // Select a list from the database
    public function getList()
    {
        $prepared_sql = "SELECT * FROM items WHERE list_id = ?";
        $array_values = [$this->id];

        return PDOTools::query($prepared_sql, $array_values, true);
    }

    // Add item to the database with a FK list_id
    public function addItem($item, $quantity)
    {
        $prepared_sql = "INSERT INTO items (item_id, item, quantity, list_id ) VALUES (NULL, ?, ?, ?)";
        $array_values = [$item, $quantity, $this->id];

        return PDOTools::query($prepared_sql, $array_values, false);
    }

    // Delete an item from a list and from the database
    public function deleteItem($item)
    {
        $prepared_sql = "DELETE FROM items WHERE list_id = ? AND item_id = ?";
        $array_values = [$this->id, $item];

        return PDOTools::query($prepared_sql, $array_values, false);
    }
}
