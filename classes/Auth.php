<?php


class Auth
{
    private PDO $db;


    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function login(string $email, string $password)
    {
        if (empty($email) && empty($password)) {
        $_SESSION['erro'] = '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Preencha todos os campos!
                </div>
        ';
            return false;
        }

        $email = htmlspecialchars($email);
        $password = md5(htmlspecialchars($password));

        // Consulta no banco de dados;

        $sql = $this->db->query("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$password'");

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $_SESSION['id'] = $data['id'];

            return true;
        }

        // Login inválido
        $_SESSION['erro'] = '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Dados inválidos, tente novamente!
            </div>
';
        $_SESSION['email'] = $email;

        return false;
    }

    public function check()
    {
        return isset($_SESSION['id']) && !empty($_SESSION['id']);
    }

    public function logout()
    {
        session_destroy();
    }
}
