<?php
$action = $_GET['action'] ?: null;
switch ($action) {
case 'getUserInfo':
    include_once __DIR__ . '/../action/GetUserInfoAction.php';
    $action = new GetUserInfoAction;
    $rtn = $action->doAction();
    echo json_encode($rtn);
    break;
default:
    $isExist = include_once __DIR__ . '/../action/' . ucfirst($action) . 'Action.php';
    if (!$isExist) {
        exit('Action error');
    }
    $actionClass = ucfirst($action) . 'Action'; 
    //$action = new $actionClass();
    $action = new RegisterAction;
    $rtn = $action->doAction();
    echo json_encode($rtn);
    break;
}
