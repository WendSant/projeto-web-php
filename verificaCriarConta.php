<?php

    require 'db_conexao.php';

    $nome = $_POST['inputNome'];
    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];
    $senhaRepeat = $_POST['inputSenhaRepeat'];
    if(strlen($nome) < 3){
        header("location: register.php?fieldErro=nome");
    }else if(!validaEmail($email)){
        header('location: register.php?fieldErro=email');
    }else if(strlen($senha) < 8 or strlen($senhaRepeat) < 8){
        header('location: register.php?fieldErro=senha');
    }else if($senha != $senhaRepeat){
        header('location: register.php?fieldErro=senhaNotEquals');
    }else{
        $insert = "INSERT INTO tb_usuarios(id, nome, email, senha) VALUES (null, '$nome','$email','$senha')";
        $insertDb = $conexao->query($insert);
        if($insertDb ==true){
            header('location: login.php?success=registerUser');
        }else{
            header('location: register.php?error=interno');
        }
    }



    function validaEmail($mail){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

