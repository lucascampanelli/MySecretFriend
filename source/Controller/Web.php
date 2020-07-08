<?php
    
    namespace Source\Controller;
    
    require __DIR__."/../Model/User.php";

    require __DIR__."/../Model/Group.php";

    require __DIR__."/../Model/validationUser.php";

    require __DIR__."/../Model/validationLogin.php";

    require __DIR__."/../Model/loginSuccess.php";

    require __DIR__."/../Model/registerSuccess.php";

    require __DIR__."/../Model/dashboardRequest.php";

    require __DIR__."/../Model/Email.php";

    require __DIR__."/../Model/Raffle.php";

    require __DIR__."/../Model/PasswdConfirm.php";

    use Source\Models\User;

    use Source\Models\PasswdConfirm;

    use Source\Models\Group;

    use Source\Models\Raffle;

    use Source\Models\validationLogin;

    use Source\Models\validateUser;

    use Source\Models\loginSuccess;

    use Source\Models\registerSucess;

    use Source\Models\dashboardRequest;

    use Source\Models\Email;

    use League\Plates\Engine;

    use CoffeeCode\DataLayer\DataLayer;

    session_start();

    class Web{

        private $view;
        
        public function __construct(){
            $this->view = Engine::create(__DIR__."/../../view", "php");
        }

        public function home($data) : void{

            if(isLogged()){
                dashboardRedirect();
            }

            echo $this->view->render("home", [
                "title" => "Página Inicial | ".SITE,
            ]);
        }

        public function sobre() : void{
            echo $this->view->render("about", [
                "title" => "Sobre | ".SITE,
            ]);
        }

        public function comoFunciona() : void{
            echo $this->view->render("howWorks", [
                "title" => "Como funciona | ".SITE,
            ]);
        }

        public function cadastro() : void{

            if(isLogged()){
                dashboardRedirect();
            }

            $user = new User();

                $confirmEmail = $user->find("email = :email", "email=".$_POST['email'])->fetch();

                    if(isset($confirmEmail->email)){
                        $alreadyEmail = "Ei! Esse e-mail já está cadastro. Faça seu login";
                    }

            if(validateSign($_POST['nome'], $_POST['sobrenome'], $_POST['email'], $_POST['senha'], $_POST['senhaConfirm']) == "validated" && !(isset($alreadyEmail))){
                    
                $user->nome_user = $_POST['nome'];
                $user->sobrenome_user = $_POST['sobrenome'];
                $user->email = $_POST['email'];
                $user->senha = password_hash($_POST['senha'], constant($_ENV['PASSWD_HASH']));
                $user->save();
                    if($user->fail()){
                        echo $this->view->render("home", [
                            "title" => "Página Inicial | ".SITE,
                            "erroCadastro" => $user->fail()->getMessage()
                        ]);
                    }
                    else{
                        redirectAfterRegister();
                    }
            }
            else{
                if(isset($alreadyEmail)){
                    echo $this->view->render("home", [
                        "title" => "Página Inicial | ".SITE,
                        "erroCadastro" => $alreadyEmail
                    ]);
                }
                else{
                    echo $this->view->render("home", [
                        "title" => "Página Inicial | ".SITE,
                        "erroCadastro" => validateSign($_POST['nome'], $_POST['sobrenome'], $_POST['email'], $_POST['senha'], $_POST['senhaConfirm'])
                    ]);
                }
            }
        }

        public function entrar($data):void{

            if(isLogged()){
                dashboardRedirect();
            }

            if(isset($data['autenticacao']) && $data['autenticacao'] == 'autenticacao'){

                if(validateLogin($_POST['email'], $_POST['senha']) == "validated"){
                    $user = new User();
                    $confirmEmailLogin = $user->find("email = :email", "email=".$_POST['email'])->fetch();
                    if(isset($confirmEmailLogin->email)){
                        if(isset($confirmEmailLogin->senha) && password_verify($_POST['senha'], $confirmEmailLogin->senha)){
                            $_SESSION['id_user'] = $confirmEmailLogin->id_user;
                            redirectAfterLogin();
                        }
                        else{
                            echo $this->view->render("login", [
                                "title" => "Entrar | ".SITE,
                                "erroLogin" => "Ops, o e-mail ou a senha digitada está errada"
                            ]);
                        }
                    }
                    else{
                        echo $this->view->render("login", [
                            "title" => "Entrar | ".SITE,
                            "erroLogin" => "Não existe nenhuma conta criada com esse e-mail, faça um cadastro"
                        ]);
                    }
                }
                else{
                    echo $this->view->render("login", [
                        "title" => "Entrar | ".SITE,
                        "erroLogin" => validateLogin($_POST['email'], $_POST['senha'])
                    ]);
                }
            }
            else if(isset($data['cadastro']) && $data['cadastro'] == 'cadastrosucedido'){
                echo $this->view->render("login", [
                    "title" => "Entrar | ".SITE,
                    "erroLogin" => "Muito bem! Seu cadastro foi bem-sucedido."
                ]);
            }
            else{
                echo $this->view->render("login", [
                    "title" => "Entrar | ".SITE
                ]);
            }
        }
        
        public function recuperar($data) : void{

            if(isLogged()){
                dashboardRedirect();
            }

            if(isset($data['solicitacao']) && $data['solicitacao'] == 'solicitacao'){
                if(validateRecover($_POST['emailRecover'], $_POST['formRecoverPasswd']) == "validated"){
                    $user = new User();
                    $confirmUser = $user->find("email = :email", "email=".$_POST['emailRecover'])->fetch(true);
                    $exists = false;

                    foreach($confirmUser as $verifyExistence){
                        $exists = true;
                    }

                    if($exists){
                        $token = strval(sha1(uniqid(mt_rand(0, 7), true)));
                        $recover = new PasswdConfirm();
                        $recover->user = $_POST['emailRecover'];
                        $recover->token_recover = $token;
                        $recover->save();
                        if($recover->fail()){
                            echo $this->view->render("recover", [
                                "title" => "Recuperar senha | ".SITE,
                                "erroRecuperacao" => $recover->fail()->getMessage()
                            ]);
                        }
                        else{
                            $confirmIdUser = $user->find("email = :email", "email=".$_POST['emailRecover'])->fetch();
                            $recover->token_recover = $token;
                            $recover->save();
                            $email = new Email();
                            $email->createEmail(
                                "Recuperar senha | MySecretFriend",
                                "Olá, $confirmIdUser->nome_user!<br> Você solicitou uma recuperação de senha. Acesse <a href='http://localhost/mysecretfriend/recuperar/validado/$confirmIdUser->email/$token'>http://localhost/mysecretfriend/recuperar/validado/$confirmIdUser->email/$token</a> para recuperar sua senha.",
                                $confirmIdUser->nome_user,
                                $confirmIdUser->email
                            );
                            $email->sendEmail();
                            redirectAfterRegister();
                        }
                    }
                    else{
                        echo $this->view->render("recover", [
                            "title" => "Recuperar senha | ".SITE,
                            "erroRecuperacao" => "Não foi encontrada nenhuma conta com o e-mail informado"
                        ]);
                    }
                }
                else{
                    echo $this->view->render("recover", [
                        "title" => "Recuperar senha | ".SITE,
                        "erroRecuperacao" => validateRecover($_POST['emailRecover'], $_POST['formRecoverPasswd'])
                    ]);
                }
            }
            else{
                echo $this->view->render("recover", [
                    "title" => "Recuperar senha | ".SITE
                ]);
            }
        }

        public function recuperarConfirmado($data) : void{
            if(isLogged()){
                dashboardRedirect();
            }

            $token = $data['token'];
            $email = $data['email'];

            if(isset($data['alter']) && $data['alter'] == "sucesso"){
                if(validatePasswdRecover($_POST['passwdRecover'], $_POST['passwdRecoverConfirmation']) == "validated"){
                    $senha = password_hash($_POST["passwdRecover"], constant($_ENV['PASSWD_HASH']));
                    
                    $user = new User();
                    $userAlter = $user->find("email = :user", "user=".$email);
                    $userAlter->senha = $senha;
                    $userAlter->save();
                    if($userAlter->fail()){
                        echo $this->view->render("newPasswd", [
                            "title" => "Recuperar senha | ".SITE,
                            "token" => $token,
                            "user" => $email,
                            "erroRecuperacao" => $userAlter->fail()->getMessage()
                        ]);
                    }
                    else{
                        redirectAfterRegister();
                    }
                }
                else{
                    echo $this->view->render("newPasswd", [
                        "title" => "Recuperar senha | ".SITE,
                        "token" => $token,
                        "user" => $email,
                        "erroRecuperacao" => validatePasswdRecover($_POST['passwdRecover'], $_POST['passwdRecoverConfirmation'])
                    ]);
                }
            }

            $passwdAlterFind = new PasswdConfirm();
            $passwdAlter = $passwdAlterFind->find("token_recover = :token", "token=".$token)->fetch(true);

            $exists = false;

            if(isset($passwdAlter)){
                foreach($passwdAlter as $validatePasswd){
                    if($validatePasswd->user == $email){
                        $exists = true;
                    }
                }
            }

            if($exists){
                echo $this->view->render("newPasswd", [
                    "title" => "Recuperar senha | ".SITE,
                    "token" => $token,
                    "user" => $email
                ]);
            }
            else{
                echo $this->view->render("recover", [
                    "title" => "Recuperar senha | ".SITE,
                    "erroRecuperacao" => "Ocorreu um erro ao solicitar a recuperação da senha. Tente novamente"
                ]);
            }
        }

        public function dashboard($data) : void{

            if(isset($data['secao']) && $data['secao'] == 'sair'){
                unset($_SESSION['id_user']);
                logOut();
            }

            if(isLogged()){
                $user = new User();
                $group = new Group();
                $userSearch = $user->findById($_SESSION['id_user']);
                $groupSearch = $group->find("id_user = :id", "id = ".$userSearch->id_user);
                
                if(isset($data['secao']) && $data['secao'] == "sortear"){
                    echo $this->view->render("raffle", [
                        "title" => $userSearch->nome_user." | ".SITE,
                        "nome_user" => $userSearch->nome_user,
                        "sobrenome_user" => $userSearch->sobrenome_user,
                        "email" => $userSearch->email
                    ]);
                }
                else if(isset($data['secao']) && $data['secao'] == "entrar"){
                    if(validateAddGroup($_POST['groupIdentification']) == "validated"){
                        $raffleGroups = new Raffle();
                        $addGroup = $group->find("cod_grupo = :id", "id=".$_POST['groupIdentification'])->fetch(true);
                        $addGroupRaffles = $raffleGroups->find("id_group = :id", "id=".$_POST['groupIdentification'])->fetch(true);

                        $userIsRaffle = false;
                        $userIsOwner = false;

                        if(isset($addGroup) && isset($addGroupRaffles)){
                            foreach($addGroupRaffles as $grupoRaffle){
                                if($grupoRaffle->email_user1 == $userSearch->email){
                                    $userIsRaffle = true;
                                }
                            }
    
                            foreach($addGroup as $grupo){
                                if($grupo->id_user == $_SESSION['id_user']){
                                    $userIsOwner = true;
                                }
                            }
                        }
                        
                        if($userIsRaffle && $userIsOwner == false){
                            $addGroupObject = $group->findById($_POST['groupIdentification']);
                            $addToDash = new Group();
                            $addToDash->id_user = $_SESSION['id_user'];
                            $addToDash->nome_grupo = $addGroupObject->nome_grupo;
                            $addToDash->desc_grupo = $addGroupObject->desc_grupo;
                            $addToDash->data_sorteio = $addGroupObject->data_sorteio;
                            $addToDash->preco_min = $addGroupObject->preco_min;
                            $addToDash->preco_max = $addGroupObject->preco_max;
                            $addToDash->cod_grupo = $addGroupObject->cod_grupo;
                            $addToDash->save();
                            if($addToDash->fail()){
                                $sorteios = $group->find("id_user = :id", "id=".$_SESSION['id_user'])->fetch(true);
                                echo $this->view->render("dashboard", [
                                    "title" => $userSearch->nome_user." | ".SITE,
                                    "nome_user" => $userSearch->nome_user,
                                    "sobrenome_user" => $userSearch->sobrenome_user,
                                    "email" => $userSearch->email,
                                    "grupo" => $sorteios,
                                    "falhaEntrar" => $addToDash->fail()->getMessage()
                                ]);
                            }
                            else{
                                dashboardRedirect();
                            }
                        }
                        else if($userIsOwner){
                            $sorteios = $group->find("id_user = :id", "id=".$_SESSION['id_user'])->fetch(true);
                            echo $this->view->render("dashboard", [
                                "title" => $userSearch->nome_user." | ".SITE,
                                "nome_user" => $userSearch->nome_user,
                                "sobrenome_user" => $userSearch->sobrenome_user,
                                "email" => $userSearch->email,
                                "grupo" => $sorteios,
                                "falhaEntrar" => "Ei! Você já entrou no grupo"
                            ]);
                        }
                        else if(!$userIsRaffle){
                            $sorteios = $group->find("id_user = :id", "id=".$_SESSION['id_user'])->fetch(true);
                            echo $this->view->render("dashboard", [
                                "title" => $userSearch->nome_user." | ".SITE,
                                "nome_user" => $userSearch->nome_user,
                                "sobrenome_user" => $userSearch->sobrenome_user,
                                "email" => $userSearch->email,
                                "grupo" => $sorteios,
                                "falhaEntrar" => "Código de grupo inválido"
                            ]);
                        }
                    }
                    else{
                        $sorteios = $group->find("id_user = :id", "id=".$_SESSION['id_user'])->fetch(true);
                        echo $this->view->render("dashboard", [
                            "title" => $userSearch->nome_user." | ".SITE,
                            "nome_user" => $userSearch->nome_user,
                            "sobrenome_user" => $userSearch->sobrenome_user,
                            "email" => $userSearch->email,
                            "grupo" => $sorteios,
                            "falhaEntrar" => validateAddGroup($_POST['groupIdentification'])
                        ]);
                    }
                }
                else if(isset($data['secao']) && $data['secao'] == "grupo" && isset($data['id'])){
                    $group = new Group();
                    $grupoInfo = $group->find("id_user = :id", "id=".$_SESSION['id_user'])->fetch(true);
                    $exists = false; //Condition to open a group page
                    foreach($grupoInfo as $grupos){ //Verify each group returned by $grupoInfo query
                        if($grupos->cod_grupo == $data['id']){
                            $exists = true;
                        }
                    }
                    if($exists == true){ //Rendering if the group exists
                        $amigo = new Raffle();
                        $meuAmigo = $amigo->find("id_group = :id", "id=".$data['id'])->fetch(true);
                        echo $this->view->render("group", [
                            "title" => $userSearch->nome_user." | ".SITE,
                            "nome_user" => $userSearch->nome_user,
                            "sobrenome_user" => $userSearch->sobrenome_user,
                            "email" => $userSearch->email,
                            "grupo" => $grupoInfo,
                            "amigo" => $meuAmigo,
                            "id_grupo" => $data['id']
                        ]);
                    }
                    else{ //Redirecting if the group doesn't exist
                        dashboardRedirect();
                    }
                }
                else if(isset($data['secao']) && $data['secao'] == "criar"){
                    if(validateGroup($_POST['nome_grupo'], $_POST['desc_grupo'], $_POST['data_sorteio'], $_POST['qnt_pessoas'], $_POST['preco_min'], $_POST['preco_max']) == "validated"){
                        try{
                            $group->id_user = $_SESSION['id_user'];
                            $group->nome_grupo = $_POST['nome_grupo'];
                            $group->desc_grupo = $_POST['desc_grupo'];
                            $group->data_sorteio = $_POST['data_sorteio'];
                            $group->preco_min = $_POST['preco_min'];
                            $group->preco_max = $_POST['preco_max'];
                            $group->cod_grupo = $_SESSION['id_user'];
                            $group->save();
                            $group->cod_grupo = $group->id_group;
                            $group->save();
                                if($group->fail()){
                                    echo $this->view->render("raffle", [
                                        "title" => $userSearch->nome_user." | ".SITE,
                                        "nome_user" => $userSearch->nome_user,
                                        "sobrenome_user" => $userSearch->sobrenome_user,
                                        "email" => $userSearch->email,
                                        "erroCriacao" =>  $group->fail()->getMessage()
                                    ]);
                                }
                                else{
                                    $qnt_pessoas = ($_POST['qnt_pessoas']);
                                    $alreadyRaffled = array();
                                    $nome_convidado = $_POST['pessoa'];
                                    $email_convidado = $_POST['email'];

                                    for($i = 0; $i <= $qnt_pessoas; $i++){
                                        if($i == $qnt_pessoas){
                                            $raffle = rand(0, ($qnt_pessoas));
                                            do{
                                                $raffle = rand(0, ($qnt_pessoas));
                                            }while(in_array($raffle, $alreadyRaffled) || $raffle == $i);
                                            array_push($alreadyRaffled, $raffle);

                                            $raffleSet = new Raffle();
                                            $raffleSet->id_group = $group->id_group;
                                            $raffleSet->nome_user1 = $userSearch->nome_user;
                                            $raffleSet->email_user1 = $userSearch->email;
                                            $raffleSet->nome_user2 = $nome_convidado[$raffle];
                                            $raffleSet->email_user2 = $email_convidado[$raffle];
                                            $raffleSet->save();  

                                            $email = new Email();
                                            $email->createEmail(
                                                "Ei! Vem espiar quem é seu amigo secreto!",
                                                "Olá, $userSearch->nome_user!<br>Você tirou <strong>$nome_convidado[$raffle]</strong> no amigo secreto. Não conta pra ninguém, hein?! <br> O código do grupo é $group->id_group, crie ou entre em sua conta e adicione o grupo para não esquecer. :)",
                                                $userSearch->nome_user,
                                                $userSearch->email
                                            );
                                            $email->sendEmail();
                                        }
                                        else{
                                            do{
                                                $raffle = rand(0, ($qnt_pessoas));
                                            }while(in_array($raffle, $alreadyRaffled) || $raffle == $i);
        
                                            array_push($alreadyRaffled, $raffle);
                                            
                                            if($raffle == $qnt_pessoas){
                                                $email = new Email();
                                                $email->createEmail(
                                                    "Ei! Vem espiar quem é seu amigo secreto!",
                                                    "Olá, $nome_convidado[$i]!<br>Você tirou <strong>$userSearch->nome_user $userSearch->sobrenome_user</strong> no amigo secreto. Não conta pra ninguém, hein?! <br> O código do grupo é $group->id_group, crie ou entre em sua conta e adicione o grupo para não esquecer. :)",
                                                    $nome_convidado[$i],
                                                    $email_convidado[$i]
                                                );
                                                $email->sendEmail();

                                                $raffleSet = new Raffle();
                                                $raffleSet->id_group = $group->id_group;
                                                $raffleSet->nome_user1 = $nome_convidado[$i];
                                                $raffleSet->email_user1 = $email_convidado[$i];
                                                $raffleSet->nome_user2 = $userSearch->nome_user;
                                                $raffleSet->email_user2 = $userSearch->email;
                                                $raffleSet->save();   
                                            }
                                            else{
                                                $email = new Email();
                                                $email->createEmail(
                                                    "Ei! Vem espiar quem é seu amigo secreto!",
                                                    "Olá, $nome_convidado[$i]<br>Você tirou <strong>$nome_convidado[$raffle]</strong> no amigo secreto. Não conta pra ninguém, hein?! <br> O código do grupo é $group->id_group, crie ou entre em sua conta e adicione o grupo para não esquecer. :)",
                                                    $nome_convidado[$i],
                                                    $email_convidado[$i]
                                                );
                                                $email->sendEmail();
            
                                                $raffleSet = new Raffle();
                                                $raffleSet->id_group = $group->id_group;
                                                $raffleSet->nome_user1 = $nome_convidado[$i];
                                                $raffleSet->email_user1 = $email_convidado[$i];
                                                $raffleSet->nome_user2 = $nome_convidado[$raffle];
                                                $raffleSet->email_user2 = $email_convidado[$raffle];
                                                $raffleSet->save();   
                                            }
                                                    
                                        }            
                                    }
                                        dashboardRedirect();
                                }              
                            }catch(Exception $e){
                                echo $this->view->render("raffle", [
                                    "title" => $userSearch->nome_user." | ".SITE,
                                    "nome_user" => $userSearch->nome_user,
                                    "sobrenome_user" => $userSearch->sobrenome_user,
                                    "email" => $userSearch->email,
                                    "erroCriacao" => $e
                                ]);
                            }      
                        }              
                    else{
                        echo $this->view->render("raffle", [
                            "title" => $userSearch->nome_user." | ".SITE,
                            "nome_user" => $userSearch->nome_user,
                            "sobrenome_user" => $userSearch->sobrenome_user,
                            "email" => $userSearch->email,
                            "erroCriacao" => validateGroup($_POST['nome_grupo'], $_POST['desc_grupo'], $_POST['data_sorteio'], $_POST['qnt_pessoas'], $_POST['preco_min'], $_POST['preco_max'])
                        ]);
                    }
                }
                else{
                    $sorteios = $group->find("id_user = :id", "id=".$_SESSION['id_user'])->fetch(true);
                    echo $this->view->render("dashboard", [
                        "title" => $userSearch->nome_user." | ".SITE,
                        "nome_user" => $userSearch->nome_user,
                        "sobrenome_user" => $userSearch->sobrenome_user,
                        "email" => $userSearch->email,
                        "grupo" => $sorteios
                    ]);
                }
            }
            else{
                echo $this->view->render("login", [
                    "title" => "Entrar | ".SITE,
                    "erroLogin" => "Faça login para acessar a plataforma"
                ]);
            }

            

        }

        public function error($data):void{
            echo "<h1> Opa! Erro {$data["errcode"]}</h1>";
            
            /*echo $this->view->render("home", [
                "title" => "Home | ".SITE,
                "users" => $users
            ]);*/
        }

    }