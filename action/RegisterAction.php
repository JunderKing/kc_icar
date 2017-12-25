<?php
include_once __DIR__ . '/BaseAction.php';

class RegisterAction extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            $paramArr = $this->getParam(array('userId'));
            extract($paramArr);

            $sql = "UPDATE user SET status=1 WHERE id=$userId";
            $flag = $this->dbUpdate($sql);

            $rtn['errcode'] = 0;
        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
