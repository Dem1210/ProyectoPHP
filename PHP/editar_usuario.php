<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];

    $stmt = $conn->prepare("UPDATE users SET nombre = ?, apellido = ?, fecha_nacimiento = ?, telefono = ?, rol = ?, fecha_actualizacion = NOW() WHERE id = ?");
    $stmt->bind_param("sssssi", $nombre, $apellido, $fecha_nacimiento, $telefono, $rol, $id);
    $stmt->execute();
    header("Location: usuarios.php");
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <h2>Editar Usuario</h2>
    <form method="post" action="editar_usuario.php">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <p>Nombre:</p> <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>" required><br>
        <p>Apellido:</p> <input type="text" name="apellido" value="<?php echo $user['apellido']; ?>" required><br>
        <p>Fecha de Nacimiento:</p> <input type="date" name="fecha_nacimiento" value="<?php echo $user['fecha_nacimiento']; ?>" required><br>
        <p>Teléfono:</p> <input type="tel" name="telefono" value="<?php echo $user['telefono']; ?>" required><br>
        Rol: 
        <select name="rol" required>
            <option value="User" <?php if ($user['rol'] == 'User') echo 'selected'; ?>>User</option>
            <option value="Admin" <?php if ($user['rol'] == 'Admin') echo 'selected'; ?>>Admin</option>
        </select><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="usuarios.php">Volver</a>
</body>
</html>
