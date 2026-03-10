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
        if (empty($email) ||  empty($password)) {
            $_SESSION['msg']  = "<div class='alert alert-person-danger ' role='alert'>
          Preencha todos os campos: nome, e-mail e senha.
                </div>";

            return false;
        }

        $email = htmlspecialchars($email);

        $senhaForte = password_hash($password, PASSWORD_DEFAULT);

        // Consulta no banco de dados;

        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();



        if ($stmt->rowCount() > 0) {

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['senha'])) {

                $_SESSION['id'] = $user['id'];
                return true;
            }
        }


        // Login inválido
        $_SESSION['msg']  = "<div class='alert alert-person-danger ' role='alert'>
          Dados inválidos!
                </div>";

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
