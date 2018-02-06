<?php

$url = 'http://api.openweathermap.org/data/2.5/weather?q=Novosibirsk,ru&APPID=77f3d66a745888c1a1116ab10c3d8a6e';
$cashFile = 'temp.txt';

if (filemtime($cashFile) < date ('F d Y H:i:s')) {
    $contents = file_get_contents($url);
    $tempFile = fopen($cashFile, 'w');
    fwrite($tempFile, $contents);
    fclose($tempFile);
    echo 'С сайта';
}
else {
	$contents = file_get_contents($cashFile);
echo 'Кэш:';
}

$result = json_decode($contents, true);

//echo '<pre>';
//print_r($result);


$city = $result ['name'];
$temperature = ($result ['main']['temp']-273.15);
$desc = $result ['weather'][0]['description'];
$wind = $result ['wind']['speed'];
$icon = $result ['weather'][0]['icon'];
$pressure = $result ['main']['pressure'];
$date = date('d.m.Y', $result ['dt']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Lesson 4</title>
</head>

<body>
	<div>
	<h1 style="margin: 0;">Today <?= $date ?> weather in <?= $city.' '. $desc ?> </h1>
    <img style="display: inline-block;" src="https://openweathermap.org/img/w/<?= $icon ?>.png" alt="image">
    <p style="display: inline-block; margin: auto;"><?= $temperature ?></p>
    <p>Pressure: <?= $pressure ?> pha</p>
    <p>Wind: <?= $wind ?> m/sec</p>
  </div>
</body>
</html>