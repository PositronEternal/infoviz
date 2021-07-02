<?php


$data = [];

$data['title'] = 'Level 1';
$data['section1'] = ['somedata' => 'lvl2', 'title' => 'Level 2', 'Favorite Color' => 'Blue', 'somesub' => ['more data' => 'lvl3', 'title' => 'Level 3', 'another data' => 'here\'s data']];
$data['Key 1'] = 'value1';
$data['Key 2'] = 'Value 2';
$data['controls'] = [];


function build_node($data_node, $parentage = [], $level = 1)
{
  $title = $data_node['title'] ?? null;

  if (!$title) {
    return;
  }

  echo '<ul class="data-node"><h' . $level . '>' . $title . '</h' . $level . '>';

  $controls = $data_node['controls'] ?? null;

  foreach (array_filter(
    array_keys($data_node),
    function ($key) {
      return !in_array($key, ['title']);
    }
  ) as $key) {
    $node = $data_node[$key];

    $id_path = implode('_', $parentage);
    $new_keyname = str_replace(' ', '_', $key);
    $remaining_path = array_slice($parentage, 1);
    $name_path = empty($parentage) ? '' :  $parentage[0] . (empty($remaining_path) ? '' : '[' . implode('][', $remaining_path) . ']') . '[' . $new_keyname . ']';

    $path_key = $id_path . ($id_path ? '_' : '') . $new_keyname;

    if (is_array($node)) {
      array_push($parentage, $new_keyname);
      build_node($node, $parentage, $level + 1);
      array_pop($parentage);
    } else {

      if ($key == 'controls') {
        // handle controls building
      } else {
        echo '<li class="data-leaf"><label for="' . $path_key . '">' . $key . '</label><input id="' . $path_key . '" type="text" name="' . $name_path . '" value="' . $data_node[$key] . '"></li>';
      }
    }
  }

  echo '</ul>';
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/infoviz.css">
  <script src="/js/infoviz.js"></script>
  <title>Hot PHP Apache Mysql!!!</title>
</head>

<body>
  <form action="">
    <?php

    build_node($data);

    ?>
  </form>
</body>

</html><?php
