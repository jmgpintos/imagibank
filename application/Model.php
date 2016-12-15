<?php

printFileName(__FILE__);

class Model
{

    protected $_db;

    public function __construct()
    {
       $this->_db = new Database();
    }
}
