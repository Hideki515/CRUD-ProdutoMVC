<?php

namespace App\Models\DAO;

use App\Models\Entidades\Usuario;
use Exception;

class UsuarioDAO extends BaseDAO
{
    public function listar($login = null)
    {
        if ($login) {
            $resultado = $this->select(
                "SELECT * FROM usuario WHERE login = '{$login}'"

            );

            return $resultado->fetchObject(Usuario::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM usuario'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Usuario::class);
        }

        return false;
    }

    public function salvar(Usuario $usuario)
    {
        try {

            $login = $usuario->getLogin();
            $nome = $usuario->getNome();
            $senha = $usuario->getSenha();
            $email = $usuario->getEmail();
            $permissao = $usuario->getPermissao();

            return $this->insert(
                'usuario',
                ":login,:nome,:email,:senha,:permissao",
                [
                    ':login' => $login,
                    ':nome' => $nome,
                    ':email' => $email,
                    ':senha' => $senha,
                    ':permissao' => $permissao
                ]
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    // public function atualizar(Usuario $usuario)
    // {
    //     try {

    //         $nome      = $usuario->getNome();
    //         $senha     = $usuario->getSenha();
    //         $email     = $usuario->getEmail();
    //         $permissao = $usuario->getPermissao();

    //         return $this->update(
    //             'usuario',
    //             "nome = :nome, email = :email, senha = :senha, permissao = :permissao",
    //             [
    //                 ':nome' => $nome,
    //                 ':email' => $email,
    //                 ':senha' => $senha,
    //                 ':permissao' => $permissao
    //             ],
    //             "login = :login"
    //         );

    //     } catch (\Exception $e) {
    //         throw new \Exception("Erro na atualização de dados.", 500);
    //     }
    // }

    public function atualizar(Usuario $usuario)
    {
        try {
            // Obter dados do usuário
            $nome = $usuario->getNome();
            $senha = $usuario->getSenha();
            $email = $usuario->getEmail();
            $permissao = $usuario->getPermissao();
            $login = $usuario->getLogin();

            // Executar o update
            return $this->update(
                'usuario',
                "nome = :nome, email = :email, senha = :senha, permissao = :permissao",
                [
                    ':nome' => $nome,
                    ':email' => $email,
                    ':senha' => $senha,
                    ':permissao' => $permissao,
                    ':login' => $login
                ],
                "login = :login"
            );

        } catch (\Exception $e) {
            // Relançar a exceção com mais detalhes
            throw new \Exception("Erro na atualização de dados: " . $e->getMessage(), 500);
        }
    }


    public function excluir(Usuario $usuario)
    {
        try {
            $login = $usuario->getLogin();

            // Adicione aspas simples ao redor do valor de $login
            return $this->delete('usuario', "login = '$login'");

        } catch (Exception $e) {
            throw new \Exception("Erro ao deletar Login: " . $login . " - " . $e->getMessage(), 500);
        }

    }

    public function validarLogin(string $login): bool
    {
        // Executa a consulta utilizando o método `select`
        $resultado = $this->select("SELECT * FROM usuario WHERE login = '{$login}'");

        try {
            // Verifica se houve resultados
            return $resultado->fetch() !== false;
        } catch (\Exception $e) {

            throw new \Exception("Erro ao buscar Logins Existentes", 500);

        }
    }

}