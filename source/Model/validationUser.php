<?php
    
    use CoffeeCode\DataLayer\DataLayer;
    use Source\Models\User;

    function validateSign($nome, $sobrenome, $email, $senha, $senhaConfirm) : string{
        $user = new User();

        if($nome == "" || $nome == null || $sobrenome == "" || $sobrenome == null || $email == "" || $email == null || $senha == "" || $senha == null || $senhaConfirm == "" || $senhaConfirm == null){
            return "Faltou você preencher alguns campos.";
        }
        else if(strlen($nome) > 100){
            return "O nome digitado é grande demais para armazenar";
        }
        else if(strlen($nome) < 2){
            return "O nome digitado é pequeno demais";
        }
        else if(strlen($sobrenome) > 200){
            return "O sobrenome digitado é grande demais para armazenar";
        }
        else if(strlen($sobrenome) < 2){
            return "O sobrenome digitado é pequeno demais";
        }
        else if(strlen($email) < 5){
            return "Digite o e-mail corretamente";
        }
        else if(strlen($senha) < 8){
            return "A senha informada é muito curta. Certifique-se de que ela tenha pelo menos 8 caracteres.";
        }
        else if(strlen($senha) > 30){
            return "A senha informada é muito longa. Certifique-se de que ela tenha no máximo 30 caracteres.";
        }
        else if($senha != $senhaConfirm){
            return "As senhas digitadas não são iguais";
        }
        else{
            return "validated";
        }
    }

    function validateGroup($nome, $desc, $data, $qnt, $preco_min, $preco_max) : string{
        if(!$nome || $nome == null || $nome == ""){
            return "Dê um nome ao seu grupo antes de continuar";
        }
        else if(!$desc || $desc == null || $desc == ""){
            return "Descreva o seu grupo antes de continuar";
        }
        else if(!$data || $data == null || $data == ""){
            return "Insira a data que o sorteio será realizado";
        }
        else if($data < date("Y-m-d")){
            return "Ops, a data inserida é anterior à data atual";
        }
        else if($qnt < 3){
            return "Ei, para realizar um sorteio é necessário adicionar pelo menos 3 pessoas";
        } 
        else if((($qnt + 1) % 2) != 0){
            return "Ei, para realizar um sorteio é necessário que tenha-se um número par de pessoas no grupo";
        }
        else if(!$preco_min ||$preco_min == null || $preco_min == ""){
            return "É necessário informar um preço mínimo para o sorteio";
        }
        else if(!$preco_max ||$preco_max == null || $preco_max == ""){
            return "É necessário informar um preço máximo para o sorteio";
        }
        else{
            return "validated";
        }
    }

    function validateAddGroup(string $id) : string{
        if(!isset($id) || $id == "" || $id == null){
            return "Coloque o código do grupo que você foi convidado para entrar";
        }
        else{
            return "validated";
        }
    }
