<?php

require_once "./model/listModel.php";

class ListControl
{
    private $model;

    public function __construct()
    {
        $this->model = new ListModel();
    }

    public function listLists()
    {
        return $this->model->listAllLists();
    }

    public function createList()
    {
        if (isset($_POST['item'])) {

            $item = $_POST['item'];
            $this->model->setName($item);

            $this->model->createList();
        }
    }

    public function deleteList()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $this->model->setId($id);

            $this->model->deleteList();
        }
    }


    public function getList()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $this->model->setId($id);

            return $this->model->getList();
        }
    }

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
