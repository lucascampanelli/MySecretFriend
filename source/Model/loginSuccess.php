<?php

    function redirectAfterLogin(){
        header("location: ".url("dashboard"));
    }
    