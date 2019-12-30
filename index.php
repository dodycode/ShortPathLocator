<?php
require_once 'vendor/autoload.php';

$graph = array(
  'Rome' => array('Amsterdam' => 3, 'London' => 3, 'Paris' => 1),
  'Paris' => array('Rome' => 2, 'London' => 1, 'Amsterdam' => 1),
  'London' => array('Paris' => 1, 'New York' => 10),
  'New York' => array('London' => 10, 'Tokyo' => 3),
  'Amsterdam' => array('Rome' => 3, 'Los Angeles' => 8),
  'Los Angeles' => array('Tokyo' => 2, 'Amsterdam' => 8),
  'Tokyo' => array('Los Angeles' => 2, 'New York' => 3)
);

if(isset($_POST['departure']) && isset($_POST['destination'])) {
  $algorithm = new \Fisharebest\Algorithm\Dijkstra($graph);

  $path = $algorithm->shortestPaths($_POST['departure'], $_POST['destination']);

  $arrays = [];

  foreach ($path as $key => $value) {
    foreach ($value as $keyInner => $valueInner) {
      array_push($arrays, $valueInner);
    }
  }
}

// echo "<img src='graph.png' style='width:300px;height:300px;' />";

// echo "<br />";

// echo implode(" -> ", $arrays);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Djiksra PHP</title>
  <link rel="stylesheet" type="text/css" href="app.css?v=1.0">
</head>
<body>
  <div class="container">
    <img src='graph.png' class="img-graph" />
    <form class="form" method="POST" action="/">
      <div style="margin-bottom: 15px;">
        <input type="text" name="departure" class="form-control" placeholder="Departure" required />
        <span> -> </span>
        <input type="text" name="destination" class="form-control" placeholder="Destination" required />
        <input type="submit" value="Go">
      </div>
      <div>
        <?php 
          if(isset($_POST['departure']) && isset($_POST['destination']))
            echo implode(" -> ", $arrays);
        ?>
      </div>
    </form>
  </div>
</body>
</html>