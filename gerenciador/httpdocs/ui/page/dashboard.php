<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 py-3">
    <div style="display: flex; align-items: center; justify-content: flex-start;">
        <h1 class="display-5"><i class="bi bi-speedometer"></i> <?php print(constant("cTitle")) ?></h1>
    </div>

    <hr class="col-lg-12 py-2">

    <div class="row">
        <div class="col-lg-6 my-5">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Proprietários</h3>
                    <h5 class="card-text"><?php print("Total: " . $totalClients); ?></h5>
                </div>
            </div>
        </div>

        <div class="col-lg-6 my-5">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Imóveis</h3>
                    <h5 class="card-text"><?php print("Total: " . $totalProperties); ?></h5>
                </div>
            </div>
        </div>

        <div class="col-lg-6 my-5">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Locações</h3>
                    <h5 class="card-text"><?php print("Total: " . $totalLocations); ?></h5>
                </div>
            </div>
        </div>

        <div class="col-lg-6 my-5">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Vendas</h3>
                    <h5 class="card-text"><?php print("Total: " . $totalSales); ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>