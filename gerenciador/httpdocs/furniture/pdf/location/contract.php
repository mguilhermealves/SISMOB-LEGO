<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contrato de Locação n° <?php print($data["n_contract"]) ?></title>

    <style>
        .lists li {
            list-style: none;
        }
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
                a(o) Sr(a) . <?php print($data["properties_attach"][0]["clients_attach"][0]["first_name"] . " " . $data["properties_attach"][0]["clients_attach"][0]["last_name"]); ?>, Brasileiro(a), PROFISSÃO, RG n° <?php print($data["properties_attach"][0]["clients_attach"][0]["rg"]); ?>, CPF: <?php print($data["properties_attach"][0]["clients_attach"][0]["document"]); ?>
                , neste ato representado pela EMPRESA, <strong>LUCIANE NEGÓCIOS IMOBILIÁRIOS LTDA EPP</strong> empresa inscrita no CNPJ/MF nº 43.225.675/0001-41, estabelecida na Rua Suíça nº 991, no Parque das Nações, em Santo André, São Paulo, CEP 09210-000, neste ato representada por sua sócia <strong>LUCIANE ARIAS PAZZINI</strong>, brasileira, divorciada, corretora de imóveis, RG nº 16.703.610-5 SSP SP e do CPF/MF nº 140.393.698-66.
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
                a(o) Sr(a) . <?php print($data["first_name"] . " " . $data["last_name"]); ?>, Brasileiro(a), PROFISSÃO, <?php print($GLOBALS["marital_status"][$data["marital_status"]]); ?>, RG n° <?php print($data["rg"]); ?>, CPF: <?php print($data["document"]); ?>, residentes e domiciliados à <?php print($data["properties_attach"][0]["clients_attach"][0]["address"]); ?>, N° <?php print($data["properties_attach"][0]["clients_attach"][0]["number_address"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["district"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["city"]); ?>, <?php print($data["properties_attach"][0]["clients_attach"][0]["uf"]); ?>.
            </td>
        </tr>

        <tr>
            <td>
                A locação ora ajustada objetiva o seguinte IMÓVEL: (descrição do imóvel locado).
            </td>
        </tr>

        <tr>
            <td>
                Endereço: <strong> <?php print($data["properties_attach"][0]["address"]); ?>, N° <?php print($data["properties_attach"][0]["number_address"]); ?>, <?php print($data["properties_attach"][0]["district"]); ?>, <?php print($data["properties_attach"][0]["city"]); ?>, <?php print($data["properties_attach"][0]["uf"]); ?> </strong>.
            </td>
        </tr>

        <tr>
            <td>
                Fim exclusivo - <strong> <?php print($GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]]); ?> </strong>.
            </td>
        </tr>

        <br>

        <tr>
            <td>
                Este contrato subordina-se às seguintes condições especiais:

                <ul class="lists">
                    <li>
                        I - Aluguel Mensal: <?php print("R$ " . number_format($data["properties_attach"][0]["price_location"], 2, ".", ",")) ?>.
                    </li>

                    <li>
                        II - Periodicidade de reajuste de alugueis / Índice: Anual / IGPM-FGV.
                    </li>
                    <li>
                        III - Data de Pagamento de aluguel: Todo dia <strong><?php print($data["day_due"]) ?></strong> de cada mês.
                    </li>
                    <li>
                        IV - Prazo de locação: <strong><?php print($data["properties_attach"][0]["deadline_contract"]) ?></strong> meses.
                    </li>
                    <li>
                        V - Inicio da Locação: xx de xxxxxxxxx de xxxx.
                    </li>
                    <li>
                        VI - Término da Locação: xx de xxxxxx de xxxx.
                    </li>
                    <li>
                        VII - Imposto Predial e Territorial Urbano POR CONTA DO LOCATÁRIO. Correspondente ao percentual de xx% (xxxxxxxxxxx), classificação fiscal junto à Prefeitura sob nº xx.xxx.xxx.
                    </li>
                    <li>
                        VIII - O imóvel foi locado para xx (xxxx) pessoas, não podendo levar mais pessoas para residir no imóvel sem autorização por escrito do locador ou administradora, sob pena de ser considerado rescindido o presente contrato, conforme clausula vigésima- terceira.
                    </li>
                    <li>
                        IX – Instalação coletiva junto à Sabesp sob RGI nº xxxxxxxxxxx; Instalação individual junto à Enel sob nº xxxxxxxxxxx.
                    </li>
                </ul>
            </td>
        </tr>

        <tr>
            <td>
                Os signatários deste instrumento, que contratam nas qualidades, aqui designados simplesmente LOCADOR e LOCATÁRIO, têm entre si justas e contratadas, a locação do imóvel aqui mencionado mediante as cláusulas e condições seguintes.

                <ul class="lists">
                    <li>
                        1 - Os aluguéis e encargos relativos a este contrato, o LOCATÁRIO se obriga a pagá-los, pontualmente, no dia de cada mês mencionado nas condições especiais, no escritório da LUCIANE NEGÓCIOS IMOBILIÁRIOS LTDA EPP.
                        Parágrafo Primeiro: Fica a livre escolha do LOCATÁRIO que o pagamento seja feito, em dinheiro, no balcão da Administradora e mediante fornecimento de recibo, ou através de boleto bancário que será enviado para o Locatário, para o e-mail que indicar, ou caso não o possua poderá retirá-lo no balcão da Administradora.
                        Parágrafo Segundo: Caso o Locatário opte pelo pagamento através de boleto bancário, para atender sua escolha e interesse, este concorda em pagar a tarifa bancária, cobrada pela instituição financeira, que será inclusa no próprio boleto.

                        OPÇÃO DE FORMA DE PAGAMENTO:
                        <br>
                        (X)<strong><?php print($GLOBALS["payment_method"][$data["payment_method"]]) ?></strong>
                        <br>
                    </li>
                    <li>
                        2 - O pagamento de aluguel e encargos através de cheque recusado pelo sacado, por qualquer motivo, torna nula e sem qualquer efeito a quitação dada constituindo o(s) LOCATÁRIO(S) em mora de pleno direito.
                    </li>
                    <li>
                        3 - O(s) LOCATÁRIO(S) declara(m) ter pleno conhecimento de que o resgate de responsabilidades posteriores não significa a quitação de outras obrigações aqui estipuladas, por qualquer motivo deixadas de cobrar nas épocas próprias, tanto de aluguéis como de encargos de quaisquer natureza.
                    </li>
                    <li>
                        4 - O atraso no pagamento do aluguel e encargos implicará na multa de 20% (vinte por cento), nos juros de mora de X% (X por cento) ao mês ou fração, e nas demais cominações legais, aplicáveis a espécie, e ainda ultrapassando de trinta dias atualização monetária calculada pelo mesmo índice utilizado no reajuste anual.
                    </li>

                    <li>
                        5 - Correm por conta do(s) LOCATÁRIO(S) todos os preços de serviços públicos e eventuais taxas condominiais relativos ao imóvel locado, inclusive multas, juros e/ou majorações a que o(s)referido(s) inquilino(s) der(em) causa, não respondendo o(s) LOCADOR(ES), por qualquer falha e ou falhas na prestação de serviços públicos água, luz, telefone, esgoto, coleta de lixo, etc. e/ou condominiais.
                    </li>
                    <li>
                        6 - Quando o pagamento dos tributos, preços de serviços públicos e/ou taxas condominiais forem efetuados pelo(s) LOCADOR(ES), o ressarcimento ser-lhe(s)-à efetuado juntamente com o primeiro aluguel seguinte ao pagamento daqueles encargos, sendo assegurado ao(s) LOCADOR(ES) o direito de recusar o recebimento do respectivo aluguel sem o cumprimento daquele reembolso.
                    </li>
                    <li>
                        7 - Obriga(m)-se o(s) LOCATÁRIO(S)a entregar imediatamente à LUCIANE NEGÓCIOS IMOBILIÁRIOS LTDA EPP, quaisquer intimações ou avisos de repartições ou autoridades, especialmente notificações para pagamento de tributos e/ou preços de serviços públicos, sob pena de responder(em), com juros e correção monetária, por acréscimo e/ou sanções decorrentes de atrasos ou descumprimento de exigências oficiais. Se, eventualmente, forem criados tributos ou preços de serviços públicos que gravem o imóvel locado ou contratos de natureza do presente, correrão tais encargos por conta do(s)LOCATÁRIO(S), que também fica(m)responsável(is) pelas obrigações fiscais a que der(em) causa.
                    </li>
                    <li>
                        8 - Tudo quanto for devido em razão deste contrato será cobrado pôr ação própria no Foro da Comarca de Santo André, São Paulo, com renúncia de qualquer outro, por mais privilegiado que seja, correndo por conta do(s) devedor(es) o principal e todas as despesas judiciais e extrajudiciais, inclusive honorários advocatícios, calculados na base de 20% (vinte por cento) sobre o valor da causa, independentemente de procedimento judicial.
                    </li>
                    <li>
                        9 - Dentro da periodicidade estabelecida na cláusula II, das CONDIÇÕES ESPECIAIS deste contrato, o aluguel será reajustado com base nos índices IGP-DI (FGV), IGP-M (FGV), IPCA (IBGE) OU INPC (IBGE) sendo usado o maior deles vigente para o período. Se a locação vier a ser prorrogada, legal ou convencionalmente, por prazo indeterminado, os reajustes futuros seguirão aquela mesma norma e idênticos períodos de incidência. Ainda que o(s) LOCADOR(ES), por qualquer motivo, deixe(m) de aplicar a majoração acima prevista, disso não induzirá renúncia a essa faculdade contratual, ficando-lhe(s) sempre assegurado o direito a majoração periódica supra mencionada. A aplicação dos índices de majoração não impedirá o exercício da retomada nos casos permitidos em lei, nem a atualização dos locativos a preço de mercado, obedecidas as condições legais para tanto.
                    </li>
                    <li>
                        10 - Quaisquer reclamações, solicitações ou pretensões do(s) LOCATÁRIO(S), com referência ao imóvel ou a este contrato, deverão ser encaminhadas a LUCIANE NEGÓCIOS IMOBILIÁRIOS LTDA EPP, a qual incumbe a administração do imóvel locado e que receberá os aluguéis e está incumbida de tomar as providências pertinentes em nome e por conta de seu(s) representado(s), ficando expressamente vedado ao(s) LOCATÁRIO(S) dirigirem-se ao(s) LOCADOR(ES) sobre estes assuntos, sob pena de grave infração contratual.
                    </li>
                    <li>
                        11 - O(s) LOCATÁRIO(S) recebe o imóvel no estado que se encontra e terá o prazo improrrogável, de 15 (quinze) dias, contados da data do recebimento das chaves, para informar a administradora, a existência de possíveis defeitos ou mau estado de conservação do imóvel para que o LOCADOR promova os reparos necessários. Na ausência de qualquer comunicação por escrito, dentro do prazo estabelecido, presumir-se-á a completa ausência de defeitos ou irregularidades, entendendo-se que o imóvel se encontra em perfeita ordem e que nada foi detectado que motive a rescisão do presente contrato; posteriormente ao prazo fixado, na eventualidade do imóvel necessitar algum reparo, exceto nos casos que se referem a obras de natureza estrutural, todas as demais ficarão por exclusiva conta do LOCATARIO sem quaisquer direitos a reembolsos ou retenção do imóvel.
                        - PARAGRAFO PRIMEIRO – O LOCATARIO declara para todos os fins e efeitos de direito, que vistoriou o imóvel e que este se encontra em perfeito estado de conservação e próprio para o uso a que se destina, sendo certo que a vistoria, assinada por todas as partes, passa a fazer parte do contrato, e se compromete, independentemente de qualquer aviso ou notificação, a promover todos os reparos necessários quando da desocupação do imóvel e devolução das chaves seja qual for o motivo na finalização da locação. No caso de que não sejam promovidos os reparos, salvo as deteriorações decorrentes do uso normal do imóvel, tanto pelo LOCATARIO quanto pelo FIADOR/ DEVEDOR SOLIDÁRIO, desde já autorizam o LOCADOR a promover os reparos e a cobrar dos devedores os valores dispêndios.
                    </li>
                    <li>
                        12 - Não poderá ser modificada a destinação do imóvel, mencionada no quadro OBJETO DA LOCAÇÃO do preâmbulo, sem prévio consentimento escrito do(s) LOCADOR(ES). Quando a destinação for comercial, esta atividade só poderá ser exercida no imóvel pelo(s) LOCATÁRIO(S) ou empresa de que participe(m) majoritariamente. Na destinação residencial será permitido o uso apenas pelo(s) LOCATÁRIO(S) e seus familiares.
                    </li>
                    <li>
                        13 - Quando, em função da destinação do imóvel, houver necessidade de atender exigências de autoridades públicas, as despesas decorrentes serão suportadas pelo(s) LOCATÁRIO(S), sem direito à reembolso, indenização ou retenção pelas obras que executar(em).
                    </li>
                    <li>
                        14 - Se a locação tiver finalidade comercial, o(s) LOCATÁRIO(S) poderá(ão), com prévia anuência escrita do(s) LOCADOR(ES),desde que não implique na segurança da estrutura do prédio, adaptar as áreas locadas e objeto deste contrato as suas atividades e necessidades,realizando acessões, benfeitorias e/ou modificações, tanto no imóvel como em suas instalações, inclusive colocação de luminosos, cartazes, placas, letreiros ou qualquer outra forma de propaganda, pintura, divisões, etc. Essas benfeitorias, passarão pertencer ao(s) IMÓVEL, independente de indenização ou compensação, não cabendo ao(s) LOCATÁRIO(S) direito de retenção, embora possam ser úteis ou necessárias.

                        - PARAGRAFO ÚNICO – Em qualquer hipótese de utilização do imóvel mesmo que não comercial, não se permitirá a realização de quaisquer benfeitorias sem previa e escrita autorização do locador a ser obtido junto a administradora, oportunidade que serão negociados eventuais reembolsos.
                    </li>
                    <li>
                        15 - Se o imóvel necessitar de reparos urgentes, vo(s) LOCATÁRIO(S) se compromete(m) a consenti-los, sendo que as obras que importarem na segurança do prédio serão executadas pelo(s) LOCADOR(ES). Todas as demais, bem como as referentes à conservação de aparelhos elétricos, sanitários, trincos, torneiras, vidraças, janelas, portas, portões, azulejos, pisos, armários, etc., bem como reparos e desobstrução de encanamentos de água, luz, gás, telefone, ralos, limpeza de fossas etc. serão feitos às expensas do(s) LOCATÁRIO(S), que se obriga(m) à restituição de tudo em perfeita ordem, sem direito à indenização ou compensação, ao desocupar o prédio. Todos os estragos porventura existentes, naquela oportunidade especialmente os causados na pintura por pregos, manchas, alterações na cor original e outras deteriorações no imóvel, deverão ser reparados pelo(s) LOCATÁRIO(S). Os reparos poderão ser efetuados, de imediato pelo(s) LOCADOR(ES), independentemente de autorização do(s) LOCATÁRIO(S) bastando, para posterior comprovação da necessidade e custo de obras, orçamento de duas empresas profissionais locais. Ao respectivo custo, serão adicionados sempre alugueis e encargos relativos ao período de trabalho das reparações. Tal como no caso de alugueis e encargos, as despesas de reparação, ficam sujeitas se houver atraso no ressarcimento a juros de 1% (um pôr cento) ao mês e se a mora for superior a 30 (trinta) dias serão corrigidas pelo mesmo índice utilizado para o reajuste anual.
                    </li>
                    <li>
                        16 - Responderá(ão) o(s) LOCATÁRIO(S) pelo incêndio do prédio, se não provar(em) caso fortuito ou força maior, vício de construção ou propagação de fogo originário em outro prédio.

                        - PARAGRAFO ÚNICO: O LOCATÁRIO(S) se obriga(m) a pagar o prêmio de seguro contra fogo que incide ou venha a incidir sobre o imóvel.
                    </li>
                    <li>
                        17 - Em caso de incêndio, sem culpa do(s) LOCATÁRIO(S), ou calamidade que determine a reconstrução do prédio, ficará rescindido o presente contrato sem nenhuma penalidade para qualquer dos contratantes.
                    </li>
                    <li>
                        18 - Nenhuma intimação de qualquer órgão público será motivo para o(s) LOCATÁRIO(S) abandonar(em) o imóvel ou pedir(em) rescisão do contrato, salvo procedendo a vistoria judicial em que apure estar o prédio ameaçado de ruína. Em caso, porém, de desapropriação, a rescisão será automática, sem ônus de espécie alguma para ambas as partes.
                    </li>
                </ul>
            </td>
        </tr>
    </table>
</body>

</html>