<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("UPDATE users SET nombre = ?, apellido = ?, fecha_nacimiento = ?, telefono = ?, fecha_actualizacion = NOW() WHERE id = ?");
    $stmt->bind_param("ssssi", $nombre, $apellido, $fecha_nacimiento, $telefono, $user_id);
    $stmt->execute();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#403d39] h-screen flex items-center justify-center flex-row text-lg">
    <div class="bg-[#ccc5b9] p-8  shadow-lg flex items-center justify-center flex-col w-[400px] h-[700px] rounded-3xl ">
    <h2 class="text-2xl font-bold mb-4">Perfil</h2>
    <form method="post" action="perfil.php"  class="mt-4 flex flex-col items-center justify-center p-2">
        Nombre: <input type="text" name="nombre" class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md" value="<?php echo $user['nombre']; ?>" required><br>
        Apellido: <input type="text" name="apellido" class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md" value="<?php echo $user['apellido']; ?>" required><br>
        Fecha de Nacimiento: <input type="date" class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md" name="fecha_nacimiento" value="<?php echo $user['fecha_nacimiento']; ?>" required><br>
        Teléfono: <input type="text" name="telefono" class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md" value="<?php echo $user['telefono']; ?>" required><br>
        <button type="submit"  class="bg-[#eb5e28] text-white px-4 shadow-md py-1 rounded-3xl ">Actualizar</button>
    </form>
    
    <?php if ($_SESSION['user_role'] == 'Admin'): ?>
        <form action="usuarios.php" method="get">
            <button type="submit"  class="bg-[#eb5e28] text-white px-4 shadow-md py-1 rounded-3xl ">Administrar Usuarios</button>
        </form>
        <?php endif; ?>
        <a href="logout.php"  class="underline decoration-[#eb5e28] text-[#252422] px-4 mt-2 shadow-md py-1 rounded-3xl ">Cerrar sesión</a>
    </div>
</body>
</html>

