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
    //Consultando pacientes do usuario

    $idUsuario = $consultado['id'];
    $selectPacientes = "SELECT * FROM `tb_pacientes` WHERE id_usuario = $idUsuario";
    $consultaPacientes = $conexao->query($selectPacientes);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pagina inicial</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-8-circle-fill"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Gerenciador de pacientes</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-list"></i>
                    <span>Listagem Inicial</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                PACIENTES
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="adicionarPacientes.php">
                    <i class="fas fa-user-plus"></i>
                    <span>Adicionar Paciente</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><strong><?php echo $consultado['nome'] ?></strong></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Seus Pacientes:</h1>
                    </div>
                    <div id="divLogout" class="alert alert-success alert-dismissible fade show" style="display: none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="divErro" class="alert alert-warning alert-dismissible fade show" style="display: none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="">
                        <div class="input-group mb-3 w-50">
                            <input type="text" class="form-control" name="pesquisa" value="" placeholder="Pesquisar" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" id="basic-addon2"><i class="fas fa-search"></i> Pesquisar</button>
                            </div>
                        </div>
                    </form>

                    <!-- Content Row -->
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Idade</th>
                                <th scope="col">Peso</th>
                                <th scope="col">Altura</th>
                                <th scope="col">IMC</th>
                                <th scope="col">Apagar</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_POST['pesquisa'])){
                                    $pesquisa = $_POST['pesquisa'];
                                    $sqlConsultaNome = "SELECT * FROM tb_pacientes WHERE nome LIKE '%$pesquisa%' AND id_usuario = $idUsuario";
                                    $resultConsulta = $conexao->query($sqlConsultaNome);
                                    if(mysqli_num_rows($resultConsulta)>0){
                                        $tas = mysqli_num_rows($resultConsulta);
                                        echo "<div class='alert alert-success alert-dismissible fade show'     role='alert'>
                                                   Resulta da pesquisa por: $pesquisa
                                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                                </button>
                                               </div>";
                                        while($resultPesquisaPorNome = mysqli_fetch_assoc($resultConsulta)){
                                            echo '<div class="modal fade" id="ModalId'.$resultPesquisaPorNome['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente apagar?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form method="POST" action="deletePaciente.php?idPaciente='.$resultPesquisaPorNome['id'].'">
                                                <button type="submit" class="btn btn-danger">Apagar</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>';

                                            echo "<tr>";
                                            echo "<td>".$resultPesquisaPorNome['nome']."</td>";
                                            echo "<td>".$resultPesquisaPorNome['idade']."</td>";
                                            echo "<td>".$resultPesquisaPorNome['peso']."</td>";
                                            echo "<td>".$resultPesquisaPorNome['altura']."</td>";
                                            echo "<td>".$resultPesquisaPorNome['imc']."</td>";
                                            echo "<td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#ModalId".$resultPesquisaPorNome['id']."'>
                                                    <i class='fas fa-trash'></i>
                                                       </button>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    }
                                }else{
                                    while($data = mysqli_fetch_assoc($consultaPacientes)){
                                        echo '<div class="modal fade" id="ModalId'.$data['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente apagar?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form method="POST" action="deletePaciente.php?idPaciente='.$data['id'].'">
                                            <button type="submit" class="btn btn-danger">Apagar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                                        echo "<tr>";
                                        echo "<td>".$data['nome']."</td>";
                                        echo "<td>".$data['idade']."</td>";
                                        echo "<td>".$data['peso']."</td>";
                                        echo "<td>".$data['altura']."</td>";
                                        echo "<td>".$data['imc']."</td>";
                                        echo "<td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#ModalId".$data['id']."'>
                                                    <i class='fas fa-trash'></i>
                                                       </button>
                                                  </td>";
                                        echo "</tr>";
                                    }
                                }


                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; WENDSON SANTANA 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Clique em sair para encerrar a sua sessão</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger" href="logout.php">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="./js/verificaErros.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>