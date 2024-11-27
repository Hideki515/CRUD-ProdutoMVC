<?php 

use App\Lib\Sessao;

if (!Sessao::retornaUsuarioLogado()) {
        // Redireciona para a página de login
        $this->redirect('/usuario/login');
        return;
    }

?>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5"><?php echo TITLE; ?></h1>
    </div>
</main>