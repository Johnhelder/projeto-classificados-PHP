<?php
    class Usuarios{
        public function cadastrar($nome, $email, $telefone, $senha){
           global $pdo;

            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
            $sql->bindValue(":email", $email);
            $sql->execute();

            if($sql->rowCount() == 0){

                $sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, telefone = :telefone, senha = :senha");
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":telefone", $telefone);
                $sql->bindValue(":senha", md5($senha));
                $sql->execute();

                return true;
            }else{
                return false;
            }
        }

        public function login($email, $senha){
            global $pdo;

            $sql = $pdo->prepare("SELECT id FROM usuarios where email = :email AND senha = :senha");
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
                $_SESSION['cLogin'] = $dados['id'];
                return true;
            }else{
                return false;
            }
        }
    }
?>