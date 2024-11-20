<?php

namespace App\Models\Entidades;

use DateTime;

class Usuario
{
    private $login;
    private $nome;
    private $senha;
    private $email;
    private $permissao;
    private $dataCadastro;

    // Getters
    public function getLogin()
    {
        return $this->login;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPermissao()
    {
        return $this->permissao;
    }

    public function getDataCadastro()
    {
        return new DateTime($this->dataCadastro);
    }

    // Setters
    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPermissao($permissao)
    {
        $this->permissao = $permissao;
    }

    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }

    public function setProduto($dados): void{
        if(isset($dados['login'])) $this->login = $dados['login'];
        $this->nome = $dados['nome'];
        $this->senha = $dados['senha'];
        $this->email = $dados['email'];
        $this->permissao = $dados['permissao'];
        if(isset($dados['dataCadastro'])) $this->dataCadastro = $dados['dataCadastro'];
    }
}