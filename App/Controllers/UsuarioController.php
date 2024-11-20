<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Util;

class UsuarioController extends Controller
{
    public function listar()
    {
        $usuarioDAO = new UsuarioDAO();  //Conecta ao Banco

        self::setViewParam('listaUsuarios', $usuarioDAO->listar()); //busca os dados

        $this->render('/usuario/listar'); //Passa os dados p/ a view listar

        Sessao::limpaMensagem();
    }

    public function editar($params)
    {
        $login = $params[0]; //Pega o id do usuario a ser editado

        $usuarioDAO = new UsuarioDAO();

        $objUsuario = $usuarioDAO->listar($login);

        if ($objUsuario == null) //Se NÃO achou usuario
        {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Falha ao recuperar dados do usuário login=' . $login . '</div>');
            $this->redirect('/usuario/listar');
        }

        self::setViewParam('usuario', $objUsuario);

        $this->render('/usuario/editar');

        Sessao::limpaMensagem();
    }

    public function salvar($param)
    {
        // Sempre limpa os erros ao entrar na função
        Sessao::limpaErro();
        $cmd = $param[0]; //Pega o comando: editar ou novo
        //Sanitização dos dados do Formulário
        $dadosform = Util::sanitizar($_POST);

        $objUsuario = new Usuario();
        //Transfere os dados do usuario do Formulário para o Objeto
        $objUsuario->setProduto($dadosform);

        $errovalidacao = false;
        //Aplicar a Validação dos Dados segundo as regras de negócio

        // Gravar Dados em variaveis.
        $login = $dadosform['login'];
        $nome = $dadosform['nome'];
        $senha = $dadosform['senha'];
        $email = $dadosform['email'];
        $permissao = $dadosform['permissao'];

        //Validação dos Dados

        if (empty($login)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroLogin', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        } else {
            if (str_contains($login, ' ')) {
                Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
                Sessao::gravaErro('erroLogin', 'Login não pode conter espaços.');
                $errovalidacao = true;
            }

            $login = trim($login);

            $usuarioDAO = new UsuarioDAO();

            if ($usuarioDAO->validarLogin($login)) {
                Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Login já existe.</div>');
                Sessao::gravaErro('erroLogin', 'Login já existe');
                $errovalidacao = true;
            }
        }

        if (empty($nome)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroNome', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        }

        if (empty($email)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroEmail', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroEmail', 'E-mail inválido');
            $errovalidacao = true;
        }

        if (empty($senha)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroSenha', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        }

        if ($permissao === 'Selecione') {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroPermissao', 'É necessário selecionar um Tipo de Permissão.');
            $errovalidacao = true;
        }


        if ($errovalidacao) { //Houve erro na validacao
            //Guarda os dados do POST na viewVar para reapresentar os dados
            self::setViewParam('usuario', $objUsuario);
            if ($cmd == 'editar') { //O usuario está sendo editado
                $this->render('/usuario/editar'); //Retorna ao Formulário de edição
            } elseif ($cmd == 'novo') { //O usuario está sendo cadastrado
                $this->render('/usuario/cadastrar'); //Retorna ao Formulário de cadastro de novo usuario
            }
            die(); //Isso é necessário senão ele vai continuar e cadastrar o usuario!!!
        }


        $usuarioDAO = new usuarioDAO(); //Conecta no Banco

        if ($cmd == 'editar') { //Salvar usuario editado
            $usuarioDAO->atualizar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuário atualizado com sucesso.</div>');
        } elseif ($cmd == 'novo') { //Salvar novo usuario
            $usuarioDAO->salvar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Novo Usuário gravado com sucesso.</div>');
        }

        //Limpa Tudo
        Sessao::limpaErro();
        //Redireciona para o listar que vai exibir msg de feedback
        $this->redirect('/usuario/listar');
    }

    public function salvarEditar($param)
    {
        // Sempre limpa os erros ao entrar na função
        Sessao::limpaErro();

        $cmd = $param[0]; //Pega o comando: editar ou novo
        //Sanitização dos dados do Formulário
        $dadosform = Util::sanitizar($_POST);

        $objUsuario = new Usuario();
        //Transfere os dados do usuario do Formulário para o Objeto
        $objUsuario->setProduto($dadosform);

        $errovalidacao = false;
        //Aplicar a Validação dos Dados segundo as regras de negócio

        // Gravar Dados em variaveis.
        $nome = $dadosform['nome'];
        $senha = $dadosform['senha'];
        $email = $dadosform['email'];
        $permissao = $dadosform['permissao'];

        //Validação dos Dados

        if (empty($nome)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroNome', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        }

        if (empty($email)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroEmail', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroEmail', 'E-mail inválido');
            $errovalidacao = true;
        }

        if (empty($senha)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroSenha', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        }

        if ($permissao === 'Selecione') {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('erroPermissao', 'É necessário selecionar um Tipo de Permissão.');
            $errovalidacao = true;
        }


        if ($errovalidacao) { //Houve erro na validacao
            //Guarda os dados do POST na viewVar para reapresentar os dados
            self::setViewParam('usuario', $objUsuario);
            if ($cmd == 'editar') { //O usuario está sendo editado
                $this->render('/usuario/editar'); //Retorna ao Formulário de edição
            } elseif ($cmd == 'novo') { //O usuario está sendo cadastrado
                $this->render('/usuario/cadastrar'); //Retorna ao Formulário de cadastro de novo usuario
            }
            die(); //Isso é necessário senão ele vai continuar e cadastrar o usuario!!!
        }


        $usuarioDAO = new usuarioDAO(); //Conecta no Banco

        if ($cmd == 'editar') { //Salvar usuario editado
            $usuarioDAO->atualizar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuário atualizado com sucesso.</div>');
            // Sempre limpa os erros ao entrar na função
            Sessao::limpaErro();
        } elseif ($cmd == 'novo') { //Salvar novo usuario
            $usuarioDAO->salvar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Novo usuário gravado com sucesso.</div>');
            // Sempre limpa os erros ao entrar na função
            Sessao::limpaErro();
        }

        //Limpa Tudo
        Sessao::limpaErro();
        //Redireciona para o listar que vai exibir msg de feedback
        $this->redirect('/usuario/listar');
    }

    public function excluirConfirma($param) //Confirma Exclusão do usuario
    {
        $param[1] = urldecode($param[1]);
        $dados = Util::sanitizar($param); //Pega o id do usuario a ser excluído e sanitiza

        $objUsuario = new usuario();
        $objUsuario->setLogin($dados[0]);  //Pega o id do usuario a ser excluído
        $objUsuario->setNome($dados[1]); //Pega o nome do usuario a ser excluído

        self::setViewParam('usuario', $objUsuario);
        $this->render('/usuario/excluirConfirma'); //Retorna ao Formulário
    }

    public function excluir($param)
    {
        $objUsuario = new usuario();
        //Pega o id do usuario a ser excluído
        $objUsuario->setLogin(Util::sanitizar($_POST['login']));

        $usuarioDAO = new usuarioDAO();

        if (!$usuarioDAO->excluir($objUsuario)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Usuário Não Encontrado.</div>');
            // Sempre limpa os erros ao entrar na função
            Sessao::limpaErro();
        } else {
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuário excluído com sucesso!.</div>');
            // Sempre limpa os erros ao entrar na função
            Sessao::limpaErro();
        }
        $this->redirect('/usuario/listar');
    }

    public function cadastrar()
    {
        $this->render('/usuario/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
}