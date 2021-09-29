<?php

function insertLocation($data)
{
    global $PDO;

    //validation here ...
    $sql = "INSERT INTO `locations` (`title`, `lat`, `lng`, `type`) VALUES ( :title, :lat, :lng, :typ);";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(['title' => $data['title'], 'lat' => $data['lat'], 'lng' => $data['lng'], 'typ' => $data['type']]);

    return $stmt->rowCount();
}
