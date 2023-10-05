<?php

include "./autoload.php";

$user = new User();

$option=1;
switch($option){
    case 1:$users = $user->getRecord();
    break;
    case 2:$users = $user->updateRecord();
    break;
    case 3:$users = $user->deleteRecord();
    break;
    case 4:$users = $user->deleteRecord();
    break;
}
print_r($users);