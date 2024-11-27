<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="mt-2">Editar dados do Usuário</h1>
                <?php
                //Mensagens de Erro ou Sucesso na execução das funções
                echo $Sessao::retornaMensagem();
                $Sessao::limpaMensagem();

                ?>

                <form action="<?php echo 'http://' . APP_HOST . '/usuario/salvarEditar/editar'; ?>" method="post"
                    id="formEditarUsuario">
                    <!-- Login -->
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control <?php if ($Sessao::retornaErro('erroLogin') != "")
                            echo "is-invalid"; ?>" name="login" value="<?php if (isset($viewVar['usuario']))
                                  echo $viewVar['usuario']->getLogin(); ?>" readonly>
                        <div class="invalid-feedback">
                            <?php echo $Sessao::retornaErro('erroLogin');
                            ?>
                        </div>
                    </div>
                    <!-- Nome -->
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control <?php if ($Sessao::retornaErro('erroNome') != "")
                            echo "is-invalid"; ?>" name="nome" value="<?php if (isset($viewVar['usuario']))
                                  echo $viewVar['usuario']->getNome(); ?>">
                        <div class="invalid-feedback">
                            <?php echo $Sessao::retornaErro('erroNome'); ?>
                        </div>
                    </div>
                    <!-- E-mail -->
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" class="form-control <?php if ($Sessao::retornaErro('erroEmail') != "")
                            echo "is-invalid"; ?>" name="email" value="<?php if (isset($viewVar['usuario']))
                                  echo $viewVar['usuario']->getEmail(); ?>">
                        <div class="invalid-feedback">
                            <?php echo $Sessao::retornaErro('erroEmail'); ?>
                        </div>
                    </div>
                    <!-- Senha -->
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control <?php if ($Sessao::retornaErro('erroSenha') != "")
                            echo "is-invalid"; ?>" name="senha" value="<?php if (isset($viewVar['usuario']))
                                  echo $viewVar['usuario']->getSenha(); ?>">
                        <div class="invalid-feedback">
                            <?php echo $Sessao::retornaErro('erroSenha'); ?>
                        </div>

                    </div>
                    <!-- Permissao -->
                    <div class="form-group">
                        <label class="permissao" for="permissao">Nível de Acesso</label> <br>
                        <select class="form-control <?php if ($Sessao::retornaErro('erroPermissao') != "")
                            echo "is-invalid"; ?>" name="permissao">
                            <option value="Selecione" hidden>Selecione</option>
                            <option value="Admin"
                                <?php echo isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() === 'Admin' ? 'selected' : ''; ?>>
                                Administrador</option>
                            <option value="Normal"
                                <?php echo isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() === 'Normal' ? 'selected' : ''; ?>>
                                Normal</option>
                            <option value="Leitura"
                                <?php echo isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() === 'Leitura' ? 'selected' : ''; ?>>
                                Somente Leitura</option>
                        </select>
                        <!-- Mensagem para Seleionar Permissão Válido -->
                        <div class="invalid-feedback">
                            <?php echo $Sessao::retornaErro('erroPermissao'); ?>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-outline-success"> <i class="bi bi-floppy"></i> Salvar</button>
                </form>
            </div>
            <div class=" col-md-3"></div>
        </div>
    </div>
</main>