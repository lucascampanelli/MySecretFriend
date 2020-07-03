<?php

    /*
        * Modelo de objeto dos grupos
    */

    namespace Source\Models;

    use CoffeeCode\DataLayer\DataLayer;

    class Raffle extends DataLayer{

        public function __construct(){

            //(nome_table, [obligatory fields], primary, bool timestamps = true)
            parent::__construct("rafflefriend", ["id_group", "nome_user1", "email_user1", "nome_user2", "email_user2"], "id_raffle", false);
        }

    }