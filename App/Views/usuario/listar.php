<main role="main" class="flex-shrink-0">
  <div class="container">

    <!-- <div class="container"> -->
    <div class="row">
      <div class="col-md-9">
        <h3 class="h3 mt-2">Manutenção de Usuários do Sistema</h3>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-2">
        <!-- Button Novo Usuário-->
        <a href="http://<?= APP_HOST ?>/usuario/cadastrar/" class="btn btn-outline-primary btn-sm mt-2">
          <i class="bi bi-patch-plus"></i> Novo Usuário
        </a>

      </div>

    </div>
    <span>
    </span>

    <?php

    //Mensagens de Erro ou Sucesso na execução das funções
    echo $Sessao::retornaMensagem();
    $Sessao::limpaMensagem();

    if (count($viewVar['listaUsuarios']) > 0) {
      echo '<div class="table-responsive">';
      echo ' <table class="table table-bordered table-hover table-sm">';
      echo ' <thead >';
      echo ' <tr style="background-color: #bee5eb;">';
      echo ' <th class="info">Login</th>';
      echo ' <th class="info">Nome</th>';
      echo ' <th class="info">E-mail</th>';
      echo ' <th class="info">Permissão</th>';
      echo ' <th class="info"></th>';
      echo ' </tr>';
      echo ' </thead>';
      echo ' <tbody>';
      foreach ($viewVar['listaUsuarios'] as $objUsuario) {
        $login = $objUsuario->getLogin();
        $nome = $objUsuario->getNome();
        $email = $objUsuario->getEmail();
        $permissao = $objUsuario->getPermissao();
        // $dataCadastro = ($objUsuario->getDataCadastro())->format('d/m/Y');
    
        echo '<tr>';
        echo ' <td>' . $login . '</td>';
        echo ' <td>' . $nome . '</td>';
        echo ' <td>' . $email . '</td>';
        echo ' <td>' . $permissao . '</td>';
        // echo ' <td>'.$qtde.'</td>';
        // echo ' <td>'.$dataCadastro.'</td>';
        echo ' <td>
            <a href="http://' . APP_HOST . '/usuario/editar/' . $login . '"
            class="btn btn-outline-success btn-sm"
            title="Editar produto <?= htmlspecialchars($login) ?>"
        aria-label="Editar produto <?= htmlspecialchars($login) ?>"><i class="bi bi-pencil-square"></i> Editar</a>

        <a href="http://' . APP_HOST . '/usuario/excluirConfirma/' . $login . '/' . urlencode($nome) . '"
            class="btn btn-outline-danger btn-sm" title="Excluir produto <?= htmlspecialchars($nome) ?>"
            aria-label="Excluir produto <?= htmlspecialchars($nome) ?>">
            <i class="bi bi-trash-fill"></i> Excluir
        </a>

        ';
        echo '</tr>';
      }
      echo ' </tbody>';
      echo ' </table>';
      echo '
    </div>';
    } else {
      echo "Nenhum Produto Encontrado.";
    }
    ?>
    <!-- <div class="position-absolute bottom-0 end-0 mb-3 me-3">
        <button class="btn btn-primary">Novo Usuário</button>
    </div> -->
  </div>
</main>