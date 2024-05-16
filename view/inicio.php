<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}

$cargo = $_SESSION["cargo"];
$nombre = $_SESSION["nombre"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="shortcut icon" href="../img/cx-removebg-preview.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.rawgit.com/jeromeetienne/jquery-qrcode/1.0/jquery.qrcode.min.js"></script>
    <title>Reclutamiento</title>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="menu-btn">
                <i class="fa-solid fa-caret-left"></i>
            </div>
            <div class="head">
                <div class="user-img">
                    <img src="../img/cx.jpeg" alt="">
                </div>
                <div class="user-datails">
                    <p class="title"><?php echo $cargo ?></p>
                    <p class="name"><?php echo $nombre ?></p>
                </div>
            </div>
            <div class="nav">
                <div class="menu">
                    <p class="title">Main</p>
                    <ul>
                        <!-- RECLUTAMIENTO -->
                        <?php if ($cargo === 'admin' || $cargo === 'reclutador') : ?>
                            <li>
                                <a>
                                    <i class="icon fa-solid fa-user-pen"></i>
                                    <span class="text">Reclutamiento</span>
                                    <i class="arrow fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="#" data-form="crear_candidato" class="pages"><span class="text">Crear</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-form="buscar_candidato" class="pages"><span class="text">Buscar</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-form="pendientes" class="pages"><span class="text">Pendientes a llamar</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-form="reagendados" class="pages"><span class="text">Reagendados</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-form="vencidos" class="pages"><span class="text">Vencidos</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-form="no_inicio" class="pages"><span class="text">No inicio Formacion</span></a>
                                    </li>
                                </ul>
                            </li>
                        <?php else : ?>
                        <?php endif; ?>
                        
                        <!-- FORMACION -->
                        <?php if ($cargo === 'admin' || $cargo === 'formador') : ?>
                            <li>
                                <a>
                                    <i class="icon fa-solid fa-graduation-cap"></i>
                                    <span class="text">Formación</span>
                                    <i class="arrow fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="#" data-form="crear_formacion" class="pages"><span class="text">Crear</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-form="buscar_formacion" class="pages"><span class="text">Buscar</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-form="buscar_socio" class="pages"><span class="text">Sociodemografico</span></a>
                                    </li>
                                </ul>
                            </li>
                        <?php else : ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="menu">
                <p class="title"></p>
                <ul>
                    <li>
                        <a class="cerrar" href="../php/cerrar_sesion.php">
                            <i class="icon fa-solid fa-power-off"></i>
                            <span class="text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <main class="main" id="main"></main>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/toggle.js"></script>

</body>

</html>