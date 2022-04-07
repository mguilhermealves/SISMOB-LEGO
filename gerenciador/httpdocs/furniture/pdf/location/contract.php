<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contrato de Locação n° <?php print($data["n_contract"]) ?></title>

    <style>

    </style>
</head>

<body>
    <h1 style="text-align: center; font-weight: 600; text-decoration:underline;">CONTRATO DE LOCAÇÃO</h1>
    <p style="text-align: center; font-weight: 600; text-decoration:underline;">Contratantes</p>

    <table style="width:100%; padding: 0 3%;">
        <tr>
            <th style="text-align: left;">LOCADOR(ES):</th>
        </tr>
        <tr>
            <td>
                a Sr(a) . <?php print($data["first_name"] . " " . $data["last_name"]); ?>, Brasileiro(a), <?php print($GLOBALS["marital_status"][$data["marital_status"]]); ?>, RG n° <?php print($data["rg"]); ?>, CPF: <?php print($data["document"]); ?>, neste ato representado pela EMPRESA, <strong>LUCIANE NEGÓCIOS IMOBILIÁRIOS LTDA EPP</strong> empresa inscrita no CNPJ/MF nº 43.225.675/0001-41, estabelecida na Rua Suíça nº 991, no Parque das Nações, em Santo André, São Paulo, CEP 09210-000, neste ato representada por  sua sócia <strong>LUCIANE ARIAS PAZZINI</strong>,  brasileira,  divorciada,  corretora  de  imóveis,  RG nº 16.703.610-5 SSP SP e do CPF/MF nº 140.393.698-66.
            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th style="text-align: left;">LOCATARIO(S)</th>
        </tr>
        <tr>
            <td>
                <?php print($data["properties_attach"][0]["clients_attach"][0]["first_name"] . " " . $data["properties_attach"][0]["clients_attach"][0]["last_name"]); ?>, CPF: <?php print($data["properties_attach"][0]["clients_attach"][0]["document"]); ?>, RG: <?php print($data["properties_attach"][0]["clients_attach"][0]["rg"]); ?>, CNH: <?php print($data["properties_attach"][0]["clients_attach"][0]["cnh"]); ?>, localizado(a) no endereço: <?php print($data["properties_attach"][0]["clients_attach"][0]["address"]); ?>, N° <?php print($data["properties_attach"][0]["clients_attach"][0]["number_address"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["district"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["city"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["uf"]); ?>.
            </td>
        </tr>

        <tr>
            <th style="text-align: left;">3. Objeto do Contrato:</th>
        </tr>
        <tr>
            <td>
                Tipo de Contrato: <?php print($GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]]); ?>, Tipo do Imóvel: <?php print($GLOBALS["propertie_types"][$data["properties_attach"][0]["type_propertie"]]); ?>, Prazo de Contrato: <?php print($GLOBALS["deadline_contract"][$data["properties_attach"][0]["deadline_contract"]]); ?>,
                localizado(a) no endereço: <?php print($data["properties_attach"][0]["address"]); ?>, N° <?php print($data["properties_attach"][0]["number_address"]); ?>, <?php print($data["properties_attach"][0]["district"]); ?>, <?php print($data["properties_attach"][0]["city"]); ?>, <?php print($data["properties_attach"][0]["uf"]); ?>.
            </td>
        </tr>

        <tr>
            <th style="text-align: left;">4. Período de duração do contrato:</th>
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