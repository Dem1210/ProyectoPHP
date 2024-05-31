<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['rol'];
        header("Location: perfil.php");
    } else {
        $error = "Email o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#403d39] h-screen flex items-center justify-center flex-row text-lg">
    <div class="bg-[#ccc5b9] p-8  shadow-lg flex items-center justify-center flex-col  w-[400px] h-[450px] rounded-3xl ">
        <h2 class="text-2xl font-bold mb-4">Inicia sesion</h2>
        <form method="post" action="login.php" class="mt-4 flex flex-col items-center justify-center p-2">
            <input class="rounded px-2 py-1 bg-[#fffcf2] border border-[#252422] rounded-3xl border-2 text-md" placeholder="Email" type="email" name="email" required><br>
            <input type="password" placeholder="Contraseña" class="rounded px-2 py-1 bg-[#fffcf2] border rounded-3xl border-[#252422] border-2 text-md"  name="password" required><br>
            <button type="submit" class="bg-[#eb5e28] text-white px-4 shadow-md py-1 rounded-3xl ">Enviar</button>
        </form>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
        <p class="mt-4 text-md"> No tienes cuenta? </p>
        <a href="register.php" class="text-md underline decoration-[#eb5e28]">Registrate</a>
    </div>
</body>
</html>
