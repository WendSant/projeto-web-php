<?php
    require('db_conexao.php');
    session_start();
    $nomePaciente = $_POST['nomePaciente'];
    $pesoPaciente = $_POST['pesoPaciente'];
    $alturaPaciente = $_POST['alturaPaciente'];
    $idadePaciente = $_POST['idadePaciente'];

    $emailSelect =  $_SESSION['email'];
    $select = "SELECT * FROM `tb_usuarios` WHERE email = '$emailSelect'";
    $consultaUsuario = $conexao->query($select);
    $usuarioConsultado = mysqli_fetch_assoc($consultaUsuario);
    $idUsuario = $usuarioConsultado['id'];
    if(strlen($nomePaciente) < 3){
        header("location: adicionarPacientes.php?fieldErro=nomePaciente");
    }else if(strlen($pesoPaciente < 2)) {
        header("location: adicionarPacientes.php?fieldErro=pesoPaciente");
    }else if(strlen($alturaPaciente < 2)){
        header("location: adicionarPacientes.php?fieldErro=alturaPaciente");
    }else if(strlen($idadePaciente) < 1){
        header("location: adicionarPacientes.php?fieldErro=idadePaciente");
    }else{
        if (strpos($pesoPaciente, ',') !== false) {$pesoPaciente = str_replace(',','.',$pesoPaciente);}
        $alturaPaciente = $alturaPaciente / 100;
        $imc = $pesoPaciente / ($alturaPaciente * $alturaPaciente);
        $imc = number_format($imc, 2);
        $insert = "INSERT INTO `tb_pacientes`(`id`, `nome`, `idade`, `peso`, `altura`, `imc`, `id_usuario`) VALUES (null,'$nomePaciente','$idadePaciente','$pesoPaciente','$alturaPaciente','$imc','$idUsuario')";
        $insertDb = $conexao->query($insert);
        if($insertDb ==true){
            header('location: index.php?success=registerPaciente');
        }else{
            header('location: adicionarPacientes.php?error=interno');
        }
    }
