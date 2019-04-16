<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="index.php"><img src="public/images/bontur-logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php"> <i class="menu-icon fa fa-desktop"></i>Dashboard </a>
                </li>

                <h3 class="menu-title">SISTEMA</h3>
                <li class="menu-item-has-children dropdown"><!-- /.menu-SEGURANCA -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Segurança</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-users"></i><a href="index.php?exe=perfil/index">Perfil</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="index.php?exe=usuarios/index">Usuários</a></li>
                    </ul>
                </li>  <!-- /.menu-SEGURANCA -->


                <li class="menu-item-has-children dropdown"><!-- /.menu-CADASTROS -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Cadastros</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-sitemap"></i><a href="index.php?exe=categorias/index">Categoria</a></li>
                        <li><i class="fa fa-puzzle-piece"></i><a href="index.php?exe=produtos/index">Produtos</a></li>
                    </ul>
                </li>  <!-- /.menu-CADASTROS -->


                <h3 class="menu-title">MOVIMENTAÇÃO</h3><!-- /.menu-MOVIMENTACAO -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Compras</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="index.php?exe=ingressos/index">Ingressos</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="index.php?exe=pontuacao/index">Ver Pontuação</a></li>
                    </ul>
                </li>  <!-- /.menu-MOVIMENTACAO -->

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
