<?php
    require 'db_conexao.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header('location: login.php?erro=2');
    }

    $emailSelect =  $_SESSION['email'];
    $select = "SELECT * FROM `tb_usuarios` WHERE email = '$emailSelect'";
    $consulta = $conexao->query($select);
    $consultado = mysqli_fetch_assoc($consulta);

    $idUsuario = $consultado['id'];
    $idPaciente = $_GET['idPaciente'];
    $deleteSql = "DELETE FROM `tb_pacientes` WHERE id = $idPaciente and id_usuario =$idUsuario;";
    $deleted = $conexao->query($deleteSql);
    if($deleted == true){
        header('location: index.php?success=deletedPaciente');
    }else{
        header('location: index.php?erro=internoDelete');
    }
