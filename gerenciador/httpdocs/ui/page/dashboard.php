<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 py-3">
    <div style="display: flex; align-items: center; justify-content: flex-start;">
        <h1 class="display-5"><i class="bi bi-speedometer"></i> <?php print(constant("cTitle")) ?></h1>
    </div>

    <hr class="col-lg-12 py-2">

    <div class="row">
        <div class="col-lg-6 my-5">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Clientes</h3>
                    <h5 class="card-text"><?php print("Total de clientes ativos: " . $totalClients); ?></h5>
                </div>
            </div>
        </div>

        <div class="col-lg-6 my-5">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total de Imóveis</h5>
                    <h3 class="card-text"><?php print("Ativos: " . $totalProperties); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-lg-6 my-5">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total de Locações</h5>
                    <h3 class="card-text"><?php print("Ativos: " . $totalLocations); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-lg-6 my-5">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total de Vendas</h5>
                    <h3 class="card-text"><?php print("Ativos: " . $totalSales); ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>