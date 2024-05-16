<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="img/cx-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <form class="form" method="post">
        <p id="heading">Login</p>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z">
                </path>
            </svg>
            <input autocomplete="off" placeholder="Username" name="user" class="input-field" type="text" required>
        </div>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                </path>
            </svg>
            <input placeholder="Password" class="input-field" name="pass" type="password" required>
        </div>
        <div class="btn">
            <button class="button1">sing In</button>
            <button type="button" id="registro" class="button2">Sign Up</button>
        </div>
        <button id="clave" type="button" class="button3">Forgot Password</button>
    </form>

    <?php
    require_once 'php/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        $query = "SELECT * FROM usuarios WHERE username = '$user' AND contraseña = '$pass'";
        $resultado = $conn->query($query);
        $row = $resultado->fetch_assoc();

        if ($resultado->num_rows > 0) {
            session_start();
            $_SESSION["nombre"] = $row["nombre"];
            $_SESSION["cargo"] = $row["cargo"];
            $_SESSION['logged_in'] = true;
            header("Location: ./view/inicio.php");
            exit;
        } else {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error de autenticación",
                        text: "Credenciales incorrectas",
                    });
                </script>';
        }

        $conn->close();
    }
    ?>

    <script src="js/script.js"></script>
</body>

</html>