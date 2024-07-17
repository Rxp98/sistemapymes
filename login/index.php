<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA VENTAS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css_nuevo/style2.css">
</head>
<body>
    <div class="background"></div>
    <div class="login-container">
        <div class="login-content">
            <h2><i class="fas fa-sign-in-alt"></i> Acceso AL Sistema</h2>
            <form action="../app/controllers/login/ingreso.php" method="post">
                <div class="input-group">
                    <label for="username"><i class="fas fa-user"></i> Usuario</label>
                    <input type="email" id="username" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
                    <input type="password" id="password" name="password_user" required>
                </div>
                <button type="submit"><i class="fas fa-arrow-right"></i> Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>
