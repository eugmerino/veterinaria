<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/veterinaria/login/css/styles.css">
  <title>Login</title>
</head>
<body>
  <div class="login-container">
    <h1>Inicia Sesión</h1>
    <form action="/veterinaria/login/validar" method="POST">
      <input type="text" name="username" placeholder="Usuario" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>