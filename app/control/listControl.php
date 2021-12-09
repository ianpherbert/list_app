<?php

/**
 * List controller class
 * @author      Ian Herbert <ianpatrickherbert@gmail.com>
 * @version     v.1.0 (09/12/2021)
 */
require_once "./model/listModel.php";

class ListControl
{
    // List model instatiation
    private $model;

    public function __construct()
    {
        $this->model = new ListModel();
    }

    // return an array of all of the lists in the database
    public function listLists()
    {
        return $this->model->listAllLists();
    }

    // Create new list in the database
    public function createList()
    {
        if (isset($_POST['item'])) {

            $item = $_POST['item'];
            $this->model->setName($item);

            $this->model->createList();
        }
    }

    // Delete list from database
    public function deleteList()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $this->model->setId($id);

            $this->model->deleteList();
        }
    }

    // Retrieve a specific list from the database
    public function getList()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $this->model->setId($id);

            return $this->model->getList();
        }
    }

    // Add item to a specified list
    public function addItem()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $this->model->setId($id);

            $item = $_POST["item"];
            $quantity = $_POST["quantity"];


            $this->model->addItem($item, $quantity);
        }
    }

    // Delete item from a specified list 
    public function deleteItem()
    {
        if (isset($_GET['id']) && isset($_GET["item"])) {
            $id = $_GET['id'];

            $this->model->setId($id);
            $item = $_GET['item'];

            $this->model->deleteItem($item);
        }
    }
}
