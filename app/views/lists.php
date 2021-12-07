<div class="container content">
    <h1>Lists</h1>
    <?php
    require_once "./control/listControl.php";

    $control = new ListControl();


    if (isset($_GET["action"])) {
        $action = $_GET["action"];

        switch ($action) {
            case 'add':
                $control->createList();
                break;
            case 'delete':
                $control->deleteList();
                break;
        }
    }
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date</th>
            </tr>
        </thead>


        <?php
        foreach ($control->listLists() as $list) {
        ?>
            <tr>
                <td>
                    <a href="?type=list&id=<?php echo $list['list_id'] ?>&name=<?php echo $list['name'] ?>" class="btn btn-primary"><?php echo $list['name']; ?></a>
                </td>
                <td>
                    <?php echo $list['date']; ?>
                </td>
                <td>
                    <a href="?action=delete&id=<?php echo $list['list_id'] ?>" class="btn btn-danger">-</a>
                </td>
            </tr>

        <?php
        }
        ?>
    </table>

</div>
<div class="bottom">
    <form method="POST" action="?action=add">

        <button class="btn btn-info">Ajouter</button>

        <input type="text" class="form-control" name="item">

    </form>


</div>