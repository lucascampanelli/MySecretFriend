<?php

    function isLogged():bool{
        if(isset($_SESSION['id_user']) && $_SESSION['id_user'] != ""){
            return true;
        }
        else{
            return false;
        }
    }

    function dashboardRedirect():void{
        header("Location: ".url("dashboard"));
    }

    function logOut():void{
        header("Location: ".url());
    }