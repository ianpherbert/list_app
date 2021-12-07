<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="assets/styles.css" rel="stylesheet" />
</head>

<body>
  <?php
  if (isset($_GET['type'])) {
    $type = $_GET['type'];
    switch ($type) {
      case 'list':
        require_once "views/list.php";
        break;
      default:
        require_once "views/lists.php";
        break;
    }
  } else {
    require_once "views/lists.php";
  }

  ?>
</body>

</html>