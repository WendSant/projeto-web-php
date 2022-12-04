
<?php

    include('db_conexao.php');

    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];

    $hostname = "localhost";
    $user = "root";
    $password = "root";
    $dataBase = "db_projetoWeb";

    $conexao = new mysqli($hostname, $user, $password, $dataBase);

    if(mysqli_connect_error()) trigger_error(mysqli_connect_error());
    echo mysqli_connect_error();

    $select = "SELECT * FROM tb_usuarios WHERE email ='$email' and senha='$senha'";

    $consulta = $conexao->query($select);

    if(mysqli_num_rows($consulta) > 0){
        session_start();
        $_SESSION['login']='ok';
        $_SESSION['email']=$email;
        header('location: index.php');
    }else{
        header('location: login.php?erro=1');
    }

?>
