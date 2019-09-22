<?php
require("./src/Db.php");
require("./src/UsersDbHandler.php");

$email = isset($_POST['form__email']) ? $_POST['form__email'] : null;
$password = isset($_POST['form__password']) ? $_POST['form__password'] : null;
if (($email === null) || ($password === null)) {
    echo "Data is not valid";
    die();
}
$connection = Db::getInstance();
$db = new UsersDbHandler($connection);
$queryRes = $db->addUser($email, $password);
$queryRes = json_decode($queryRes, true);
if (!$queryRes["status"]) {
    echo $queryRes["message"];
    die();
}
echo "User has been added, hashed password:" . $queryRes["password"];





