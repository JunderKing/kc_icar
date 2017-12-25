<?php
include_once __DIR__ . '/../model/DB.class.php';

class BaseAction {
    private $mysql;

    public function getParam ($paramArr) {
        $result = array();
        foreach ($paramArr as $value) {
            $result[$value] = isset($_REQUEST[$value]) ? $_REQUEST[$value] : null;
            if ($result[$value] === null) {
                $errJson = json_encode(array(
                    'errcode' => 100,
                    'errmsg' => 'Param error',
                ));
                throw new Exception($errJson);
            }
        }
        return $result;
    }

    public function dbSelect ($sql) {
        if (!$this->mysql) {
            $this->mysql = new DB();
        }
        return $this->mysql->select($sql);
    }

    public function dbUpdate ($sql) {
        if (!$this->mysql) {
            $this->mysql = new DB();
        }
        return $this->mysql->update($sql);
    }

    public function writeLog ($e, &$rtn) {
        $errmsg = $e->getMessage();
        $errArr = json_decode($errmsg, true);
        if ($errArr) {
            $rtn['errcode'] = $errArr['errcode'];
            $errmsg = $errArr['errmsg'];
        }
        $logStr = json_encode(array(
            'Time' => date("Y-m-d H:i:s", time()),
            'File' => $e->getFile(),
            'Line' => $e->getLine(),
            'Error' => $errmsg,
        ));
        $logStr = stripslashes($logStr) . "\n";
        file_put_contents(__DIR__ . '/../log/error.log', $logStr, FILE_APPEND);
    }
}
