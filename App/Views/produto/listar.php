    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Listagem de Produtos</h1>

            <?php

        //Mensagens de Erro ou Sucesso na execução das funções
        echo $Sessao::retornaMensagem();
        $Sessao::limpaMensagem();

        if (count($viewVar['listaProdutos'])>0){
          echo '<div class="table-responsive">';
          echo ' <table class="table table-bordered table-hover table-sm">';
          echo ' <thead >';
          echo ' <tr style="background-color: #bee5eb;">';
          echo ' <th class="info">Id</th>';
          echo ' <th class="info">Nome</th>';
          echo ' <th class="info">Descrição</th>';
          echo ' <th class="info">Preço</th>';
          echo ' <th class="info">Qtde.</th>';
          echo ' <th class="info">Cadastro</th>';
          echo ' <th class="info"></th>';
          echo ' </tr>';
          echo ' </thead>';
          echo ' <tbody>';
          foreach ($viewVar['listaProdutos'] as $objProduto) {
            $id = $objProduto->getId();
            $nome = $objProduto->getNome();
            $preco = $objProduto->getPreco();
            $qtde = $objProduto->getQuantidade();
            $descricao = $objProduto->getDescricao();
            $dataCadastro = ($objProduto->getDataCadastro())->format('d/m/Y');
                                
            echo '<tr>';
            echo ' <td>'.$id.'</td>';
            echo ' <td>'.$nome.'</td>';
            echo ' <td>'.$descricao.'</td>';
            echo ' <td>'.$preco.'</td>';
            echo ' <td>'.$qtde.'</td>';
            echo ' <td>'.$dataCadastro.'</td>';
            echo ' <td>
            <a href="http://'.APP_HOST.'/produto/editar/'.$id.'"
            class="btn btn-info"
            title="Editar produto <?= htmlspecialchars($id) ?>"
            aria-label="Editar produto <?= htmlspecialchars($id) ?>"><i class="bi bi-pencil-square"></i> Editar</a>

            <a href="http://'.APP_HOST.'/produto/excluirConfirma/'.$id.'/'.urlencode($nome).'" class="btn btn-danger"
                title="Excluir produto <?= htmlspecialchars($nome) ?>"
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
        }else {
        echo "Nenhum Produto Encontrado.";
        }
        ?>

        </div>
    </main>