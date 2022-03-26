<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contrato de Locação n° <?php print($data["n_contract"]) ?></title>

    <style>

    </style>
</head>

<body>
    <p style="text-align: center; font-weight: 600">Contrato de Locação n° <?php print($data["n_contract"]) ?></p>

    <table style="width:100%; padding: 0 3%;">
        <tr>
            <th style="text-align: center;">1. Dados do Locatário</th>
        </tr>
        <tr>
            <td>
                <?php print($data["first_name"] . " " . $data["last_name"]); ?>, CPF: <?php print($data["document"]); ?>, RG: <?php print($data["rg"]); ?>, CNH: <?php print($data["cnh"]); ?>, localizado(a) no endereço: <?php print($data["address"]); ?>, N° <?php print($data["number_address"]); ?>, <?php print($data["district"]); ?>, <?php print($data["city"]); ?>, <?php print($data["uf"]); ?>.
            </td>
        </tr>
        
        <tr>
            <th style="text-align: center;">2. Dados do Proprietário:</th>
        </tr>
        <tr>
            <td>
                <?php print($data["properties_attach"][0]["clients_attach"][0]["first_name"] . " " . $data["properties_attach"][0]["clients_attach"][0]["last_name"]); ?>, CPF: <?php print($data["properties_attach"][0]["clients_attach"][0]["document"]); ?>, RG: <?php print($data["properties_attach"][0]["clients_attach"][0]["rg"]); ?>, CNH: <?php print($data["properties_attach"][0]["clients_attach"][0]["cnh"]); ?>, localizado(a) no endereço: <?php print($data["properties_attach"][0]["clients_attach"][0]["address"]); ?>, N° <?php print($data["properties_attach"][0]["clients_attach"][0]["number_address"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["district"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["city"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["uf"]); ?>.
            </td>
        </tr>

        <tr>
            <th style="text-align: center;">3. Objeto do Contrato:</th>
        </tr>
        <tr>
            <td>
                Tipo de Contrato: <?php print($GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]]); ?>, Tipo do Imóvel: <?php print($GLOBALS["propertie_types"][$data["properties_attach"][0]["type_propertie"]]); ?>, Prazo de Contrato: <?php print($GLOBALS["deadline_contract"][$data["properties_attach"][0]["deadline_contract"]]); ?>,
                localizado(a) no endereço: <?php print($data["properties_attach"][0]["address"]); ?>, N° <?php print($data["properties_attach"][0]["number_address"]); ?>, <?php print($data["properties_attach"][0]["district"]); ?>, <?php print($data["properties_attach"][0]["city"]); ?>, <?php print($data["properties_attach"][0]["uf"]); ?>.
            </td>
        </tr>

        <tr>
            <th style="text-align: center;">4. Período de duração do contrato:</th>
        </tr>
        <tr>
            <td>
                <?php print($GLOBALS["deadline_contract"][$data["properties_attach"][0]["deadline_contract"]]); ?>.
            </td>
        </tr>

        <tr>
            <th style="text-align: center;">5. Forma de pagamento:</th>
        </tr>
        <tr>
            <td>
                <?php print($GLOBALS["payment_method"][$data["payment_method"]]); ?>.
            </td>
        </tr>

        <tr>
            <th style="text-align: center;">6. Local e data:</th>
        </tr>
        <tr>
            <td>
                <?php print(date('d')) ?> de <?php print(date('m')) ?> de <?php print(date('Y')) ?>
            </td>
        </tr>

        <tr>
            <td>
                <strong>Assinatura Locatário:</strong>
                <p>________________________________________________</p>
            </td>
        </tr>

        <tr>
            <td>
                <strong>Assinatura Proprietário:</strong>
                <p>________________________________________________</p>
            </td>
        </tr>
    </table>
</body>

</html>