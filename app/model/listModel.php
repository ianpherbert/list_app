<?php

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

    public function listAllLists()
    {
        $data = PDOTools::query("SELECT * FROM lists", [], true);

        return $data;
    }

    public function createList()
    {
        $prepared_sql = "INSERT INTO lists (list_id, name, date ) VALUES (NULL, ?, NOW())";
        $array_values = [$this->name];

        return PDOTools::query($prepared_sql, $array_values, false);
    }

    public function deleteList()
    {
        $prepared_sql = "DELETE FROM lists WHERE list_id = ?";
        $array_values = [$this->id];

        return PDOTools::query($prepared_sql, $array_values, false);
    }

    public function getList()
    {
        $prepared_sql = "SELECT * FROM items WHERE list_id = ?";
        $array_values = [$this->id];

        return PDOTools::query($prepared_sql, $array_values, true);
    }
    public function addItem($item, $quantity)
    {
        $prepared_sql = "INSERT INTO items (item_id, item, quantity, list_id ) VALUES (NULL, ?, ?, ?)";
        $array_values = [$item, $quantity, $this->id];

        return PDOTools::query($prepared_sql, $array_values, false);
    }

    public function deleteItem($item)
    {
        $prepared_sql = "DELETE FROM items WHERE list_id = ? AND item_id = ?";
        $array_values = [$this->id, $item];

        return PDOTools::query($prepared_sql, $array_values, false);
    }
}
