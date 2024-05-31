<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("INSERT INTO users (nombre, apellido, email, password, fecha_nacimiento, telefono) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $apellido, $email, $password, $fecha_nacimiento, $telefono);
    $stmt->execute();

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#403d39] h-screen flex items-center justify-center flex-row text-lg">
    <div class="bg-[#ccc5b9] p-8  shadow-lg flex items-center justify-center flex-col w-[400px] h-[700px] rounded-3xl ">
        <h2 class="text-2xl font-bold mb-4">Crea una cuenta</h2>
        <form method="post" action="register.php"  class="mt-4 flex flex-col items-center justify-center p-2">
            <input type="text" placeholder="Nombre" name="nombre" required class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md"><br>
            <input type="text" placeholder="Apellido" name="apellido" required class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md"><br>
            <input type="email" placeholder="Email" name="email" required class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md"><br>
            <input type="password" placeholder="Contraseña" name="password" required class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md"><br>
            <p class="text-md m-0">Fecha de nacimiento:</p><br>
            <input type="date"  name="fecha_nacimiento" required class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md"><br>
            <input type="tel" placeholder="Telefono" name="telefono" required class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md"><br>
            <button type="submit" class="bg-[#eb5e28] text-white px-4 shadow-md py-1 rounded-3xl ">Enviar</button>
        </form>
        <p class="mt-4 text-md"> Ya tienes cuenta? <a href="login.php" class="text-md underline decoration-[#eb5e28]">Inicia sesion</a></p>
        
    </div>
</body>
</html>
