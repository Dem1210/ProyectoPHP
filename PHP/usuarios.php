<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    header("Location: usuarios.php");
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#403d39] h-screen flex items-center justify-center flex-col text-lg">
    <div class="bg-[#ccc5b9] p-8  shadow-lg flex items-center justify-center flex-col  rounded-3xl ">
        <h2 class="text-2xl font-bold mb-4">Usuarios</h2>
        <table  class="bg-[#fffcf2]  border-[#252422]  p-4 border-2 text-md">
            <tr class="bg-[#252422] text-white ">
                <th class="p-2">Nombre</th>
                <th class="p-2">Apellido</th>
                <th class="p-2">Email</th>
                <th class="p-2">Fecha de Nacimiento</th>
                <th class="p-2">Teléfono</th>
                <th class="p-2">Rol</th>
                <th class="p-2">Acciones</th>
            </tr>
            <?php while($user = $result->fetch_assoc()): ?>
            <tr>
                <td class="p-2 border-[#252422] border-2" ><?php echo $user['nombre']; ?></td>
                <td class="p-2 border-[#252422] border-2" ><?php echo $user['apellido']; ?></td>
                <td class="p-2 border-[#252422] border-2" ><?php echo $user['email']; ?></td>
                <td class="p-2 border-[#252422] border-2" ><?php echo $user['fecha_nacimiento']; ?></td>
                <td class="p-2 border-[#252422] border-2" ><?php echo $user['telefono']; ?></td>
                <td class="p-2 border-[#252422] border-2" ><?php echo $user['rol']; ?></td>
                <td class="p-2 border-[#252422] border-2" >
                    <a class="text-md underline decoration-[#eb5e28]" href="editar_usuario.php?id=<?php echo $user['id']; ?>">Editar</a>
                    <a class="text-md underline decoration-[#eb5e28]" href="usuarios.php?delete=<?php echo $user['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <div class="flex flex-row items-center justify-center p-2">
            <a href="logout.php" class="text-md underline decoration-[#eb5e28] m-2">Cerrar sesión</a>
            <a href="perfil.php" class="text-md underline decoration-[#eb5e28] m-2">Volver al perfil</a>
        </div>
    </div>
</body>
</html>
