<?php
if (empty($_SESSION['login'])) {
    header('Location: ../../login.php');
    exit;
}
?>


<!-- Header-->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Área Administrativa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">

    <?php
    WSErro("Você entrou no sistema", WS_ACCEPT, 'Sucesso');
    ?>

    <div class="col-xl-3 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Total de Vendas</div>
                        <div class="stat-digit">1,012</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Clientes</div>
                        <div class="stat-digit">961</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Pontos</div>
                        <div class="stat-digit">770</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-close text-warning border-warning"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Cancelados</div>
                        <div class="stat-digit">770</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-2">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count">10468</span>
                </h4>
                <p class="text-light">Total de Clientes</p>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    <canvas id="widgetChart2"></canvas>
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->



    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-2">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count">10468</span>
                </h4>
                <p class="text-light">Total de Clientes</p>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    <canvas id="widgetChart2"></canvas>
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-3">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count">10468</span>
                </h4>
                <p class="text-light">Total de Produtos</p>

            </div>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart3"></canvas>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-3">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count">10468</span>
                </h4>
                <p class="text-light">Total de Produtos</p>

            </div>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart3"></canvas>
            </div>
        </div>
    </div>
    <!--/.col-->




    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title mb-0">Trafico</h4>
                        <div class="small text-muted">Outubro 2019</div>
                    </div>
                    <!--/.col-->
                    <div class="col-sm-8 hidden-sm-down">
                        <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i
                                    class="fa fa-cloud-download"></i></button>
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="options" id="option1"> Dia
                                </label>
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="options" id="option2" checked=""> Mês
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="options" id="option3"> Ano
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->


                </div>
                <!--/.row-->
                <div class="chart-wrapper mt-4">
                    <canvas id="trafficChart" style="height:200px;" height="200"></canvas>
                </div>

            </div>
            <div class="card-footer">
                <ul>
                    <li>
                        <div class="text-muted">Visitas</div>
                        <strong>29.703 Usuários (40%)</strong>
                        <div class="progress progress-xs mt-2" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%;"
                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    <li class="hidden-sm-down">
                        <div class="text-muted">Unique</div>
                        <strong>24.093 Usuários (20%)</strong>
                        <div class="progress progress-xs mt-2" style="height: 5px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    <li>
                        <div class="text-muted">Páginas Visitadas</div>
                        <strong>78.706 Views (60%)</strong>
                        <div class="progress progress-xs mt-2" style="height: 5px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;"
                                 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    <li class="hidden-sm-down">
                        <div class="text-muted">Novos Usuários</div>
                        <strong>22.123 Usuários (80%)</strong>
                        <div class="progress progress-xs mt-2" style="height: 5px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%;"
                                 aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4>Mundo</h4>
            </div>
            <div class="Vector-map-js">
                <div id="vmap" class="vmap" style="height: 265px;"></div>
            </div>
        </div>
        <!-- /# card -->
    </div>

</div> <!-- .content -->

