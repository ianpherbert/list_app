<div class="container content">
    <?php if (isset($_GET['name'])) {
        $name = $_GET['name'];
    } else {
        $name = "List";
    } ?>


    <h1>
        <?php echo $name ?> </h1>
    <a href="?">See all</a>
    <?php
    require_once "./control/listControl.php";

    $control = new ListControl();
    $id = $_GET['id'];

    if (isset($_GET["action"])) {
        $action = $_GET["action"];

        switch ($action) {
            case 'add':
                $control->addItem();
                break;
            case 'delete':
                $control->deleteItem();
                break;
        }
    }
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Quantité</th>
            </tr>
        </thead>


        <?php
        $dataSet = $control->getList();
        if (is_countable($dataSet)) {
            foreach ($dataSet as $item) {
        ?>
                <tr>
                    <td>
                        <?php echo $item['item']; ?>
                    </td>
                    <td>
                        <?php echo $item['quantity']; ?>
                    </td>
                    <td>
                        <a href="?type=list&action=delete&id=<?php echo $id ?>&item=<?php echo $item['item_id'] ?>&name=<?php echo $name ?>" class="btn btn-danger">-</a>
                    </td>
                </tr>

        <?php
            }
        }
        ?>
    </table>

</div>
<div class="bottom">
    <form method="POST" action="?type=list&id=<?php echo $id ?>&action=add&name=<?php echo $name ?>">

        <button class="btn btn-info">Ajouter</button>

        <input type="text" class="form-control" name="item">
        <input type="number" class="form-control" name="quantity" value="1">

    </form>


</div>