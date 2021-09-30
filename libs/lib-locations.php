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


function getLocations($params = [])
{
    global $PDO;
    $condition = '';
    if (isset($params['verified']) and in_array($params['verified'], ['0', '1'])) {
        $condition = "where verified = {$params['verified']}";
    }
    $sql = "SELECT * FROM `locations` $condition ";
    $stmt = $PDO->prepare($sql);
    $result = $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


function getLocation($id)
{
    global $PDO;
    $sql = "SELECT * FROM `locations` where id = :id";
    $stmt = $PDO->prepare($sql);
    $result = $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}


function toggleStatus($id)
{
    global $PDO;
    $sql = "UPDATE `locations` SET verified = 1 - verified WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $result = $stmt->execute(['id' => $id]);
    return $stmt->rowCount();
}
