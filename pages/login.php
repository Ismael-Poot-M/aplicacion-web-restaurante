<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/estiloslogin.css" />
    <link rel="shortcut icon" href="../assets/images/Letra.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <title></title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="../includes/login_usuario_be.php" method="POST" class="sign-in-form">
                    <h2 class="title">Iniciar Sesión</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" placeholder="Correo Electronico" name="correo" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="contrasena" />
                    </div>
                    <button class="btn solid">Iniciar Sesion</button>

                </form>
                <form action="../includes/registro_usuario_be.php" method="POST" class="sign-up-form">
                    <h2 class="title">Registrar</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" placeholder="Nombre Completo" name="nombre" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Correo Electronico" name="correo" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="text" placeholder="Usuario" name="usuario" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="contrasena" />
                    </div>
                    <button class="btn">Registrar</button>

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>¿Eres nuevo aquí?</h3>
                    <p>
                        Regístrate para que puedas iniciar sesión.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Registrate
                    </button>
                </div>
                <img src="../assets/images/hamburguesa-grande.png" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>
                        Inicia sesión para entrar en la página.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Iniciar Sesión
                    </button>
                </div>
                <img src="../assets/images/pollo-frito.png" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="../assets/js/scriptlogin.js"></script>
</body>

</html>