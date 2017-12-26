<?php
include_once __DIR__ . '/../BaseAction.php';

class GetUserInfoAction extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            $paramArr = $this->getParam(array('mobile'));
            extract($paramArr);

            $sql = "SELECT * FROM user WHERE mobile=$mobile";
            $userList = $this->dbSelect($sql);
            if ($userList == null) {
                $rtn['errcode'] = 101;
                throw new Exception('No user data');
            }

            $rtn['errcode'] = 0;
            $rtn['data'] = $userList[0];
        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
