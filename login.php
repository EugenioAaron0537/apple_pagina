<?php
include("conexion.php");
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo   = mysqli_real_escape_string($conexion, $_POST['correo']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($password, $usuario['password'])) {
            echo "<script>
                    alert('¡Bienvenido/a, " . $usuario['nombre'] . "!');
                    window.location.href = 'index.html';
                  </script>";
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "No existe una cuenta con este correo.";
    }
}
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión - Apple Store</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, sans-serif; }
    body { background-color: #18181c; color: #fff; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
    .form-card { background-color: #22222a; padding: 40px; border-radius: 18px; border: 1px solid #2d2d35; width: 100%; max-width: 400px; }
    h2 { font-size: 24px; margin-bottom: 20px; text-align: center; }
    .input-group { margin-bottom: 16px; }
    label { display: block; font-size: 13px; color: #a0a0ab; margin-bottom: 6px; }
    input { width: 100%; padding: 10px 14px; background: #18181c; border: 1px solid #3d3d48; border-radius: 8px; color: #fff; font-size: 14px; outline: none; }
    input:focus { border-color: #0071e3; }
    .btn-submit { width: 100%; padding: 12px; background: #0071e3; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; margin-top: 10px; }
    .btn-submit:hover { background: #0077ed; }
    .error-msg { color: #ff453a; font-size: 13px; text-align: center; margin-bottom: 12px; }
    .back-link { display: block; text-align: center; margin-top: 16px; color: #a0a0ab; font-size: 13px; text-decoration: none; }
    .back-link:hover { color: #fff; }
  </style>
</head>
<body>
  <div class="form-card">
    <h2>Iniciar Sesión</h2>
    <?php if (!empty($mensaje)): ?>
      <p class="error-msg"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
      <div class="input-group">
        <label>Correo Electrónico</label>
        <input type="email" name="correo" required>
      </div>
      <div class="input-group">
        <label>Contraseña</label>
        <input type="password" name="password" required>
      </div>
      <button type="submit" class="btn-submit">Ingresar</button>
    </form>
    <a href="index.html" class="back-link">← Volver al inicio</a>
  </div>
</body>
</html>