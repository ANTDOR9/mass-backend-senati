<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/UsuarioRepository.php';

class AuthController {

    public function mostrarLogin(string $error = ''): void {
        require __DIR__ . '/../views/auth/login.php';
    }

    public function procesarLogin(): void {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $this->mostrarLogin('Completa usuario y contraseña.');
            return;
        }

        // Contador de intentos fallidos
        $_SESSION['intentos'] = ($_SESSION['intentos'] ?? 0);

        if ($_SESSION['intentos'] >= 3) {
            $this->mostrarLogin('Demasiados intentos fallidos. Reinicia el navegador.');
            return;
        }

        $repo    = new UsuarioRepository();
        $usuario = $repo->buscarPorUsername($username);

        if ($usuario === null || !$usuario->verificarPassword($password)) {
            $_SESSION['intentos']++;
            $intentosRestantes = 3 - $_SESSION['intentos'];
            if ($_SESSION['intentos'] >= 3) {
                $this->mostrarLogin('Demasiados intentos fallidos. Reinicia el navegador.');
            } else {
                $this->mostrarLogin("Usuario o contraseña incorrectos. Intentos restantes: $intentosRestantes.");
            }
            return;
        }

        // Login exitoso — resetear contador
        $_SESSION['intentos'] = 0;
        $_SESSION['usuario'] = [
            'id'       => $usuario->getId(),
            'username' => $usuario->getUsername(),
            'nombre'   => $usuario->getNombreCompleto(),
            'rol'      => $usuario->getRol(),
            'tienda'   => $usuario->getTienda(),
        ];
        header('Location: index.php?accion=catalogo');
        exit;
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?accion=login');
        exit;
    }
}
