<?php

namespace mvc;

class ErrorHandler{

    public function __construct(){
        if(DEBUG){
            error_reporting(E_ALL);
        }else{
            error_reporting(false);
        }

        set_exception_handler([$this, 'exception_handler']);
    }

    public function exception_handler($e){
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->printError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($msg='', $file='', $line=''){
        error_log("[" . date('d-m-Y H:i:s') . "] Ошибка: {$msg} | Файл: {$file} | Строка: {$line} \n\n",
         3, dirname(__DIR__) . '/tmp/errors.log');
    }

    protected function printError($errno, $errstr, $errfile, $errline, $res=404){
        http_response_code($res);
        if($res == 404 && !DEBUG){
            require_once dirname(__DIR__) . '/public/errors/404.php';
            die;
        }
        if(DEBUG){
            require_once dirname(__DIR__) . '/public/errors/dev_errors.php';
        }else{
            require_once dirname(__DIR__) . '/public/errors/prod_errors.php';
        }
        die;
    }
}