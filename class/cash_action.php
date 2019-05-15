<?php
    //TODO Extend class from balance_record
    require_once "class/DBController.php";
    require_once "class/balance_record.php";
    class cash_action{

        private $db_handle;
        private $balance_record;

        function __construct() {
            $this->db_handle = new DBController();
            $this->balance_record = new balance_record;
        }

        function withdraw(){


        }

        function cashIn(){


        }

    }
?>