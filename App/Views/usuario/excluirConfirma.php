<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="mt-2">Exclusão de Usuário</h1>
                <form action="<?php echo 'http://' . APP_HOST . '/usuario/excluir/'; ?>" method="post"
                    id="formExcluirusuario">
                    <input type="hidden" name="login" value="<?php echo $viewVar['usuario']->getLogin(); ?>">
                    <div class="card text-white bg-dark mb-3" style="max-width: 22 rem;">
                        <div class="card-header">Confirmação da Exclusão do Usuario</div>
                        <div class="card-body">
                            <h5 class="card-title">Excluir?</h5>
                            <p>Confirma exclusão do usuario: <?php echo $viewVar['usuario']->getNome(); ?> ?
                            </p>
                            <button type="submit" class="btn btn-outline-danger btn-sm mt2"> <i
                                    class="bi bi-check-lg"></i>
                                Confirmar</button>
                            <a href="<?php echo 'http://' . APP_HOST . '/usuario/listar/'; ?>"
                                class="btn btn-outline-success btn-sm mt2">
                                <i class="bi bi-x-octagon"></i>
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class=" col-md-3"></div>
        </div>
    </div>
</main>