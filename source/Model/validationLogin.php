<?php
    
    use CoffeeCode\DataLayer\DataLayer;

    use Source\Models\User;

    function validateLogin($email, $senha) : string{

        if($email == "" || $senha == ""){
            if($email == "" && $senha == ""){
                return "Opa, você esqueceu de digitar os campos abaixo para entrar";
            }
            else if($email == ""){
                return "Ei, você esqueceu de digitar o e-mail para entrar";
            }
            else if($senha == ""){
                return "Ei, você esqueceu de digitar a senha para entrar";
            }
            
        }

        return "validated";

    }

    function validateRecover(String $email, string $token) : string{
        if($email == "" || !isset($email) || $email == null){
            return "Informe um e-mail antes de prosseguir";
        }
        else if($token == "" || !isset($token) || $token == null){
            return "Ocorreu um erro inesperado. Tente novamente mais tarde.";
        }
        else{
            return "validated";
        }
    }

    function validatePasswdRecover(String $passwd, String $passwdConfirm) : string{
        if($passwd == "" || !isset($passwd) || $passwd == null){
            return "Informe a senha antes de prosseguir";
        }
        else if($passwdConfirm == "" || !isset($passwdConfirm) || $passwdConfirm == null){
            return "Confirme a senha antes de prosseguir";
        }
        else if($passwd != $passwdConfirm){
            return "As senhas digitadas não conferem";
        }
        else{
            return "validated";
        }
    }