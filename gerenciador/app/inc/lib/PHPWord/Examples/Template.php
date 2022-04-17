<?php
require_once '../PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('Template.docx');

$document->setValue('NUMERO_CONTRATO','-');
$document->setValue('RAZAO_SOCIAL', 'Inserir razão social');

$document->setValue('NOME_REPRESENTANTE','Nome do representante legal');
$document->setValue('RG_REPRESENTANTE','RG do representante legal');
$document->setValue('NOME_CONTATO','Nome do contato');
$document->setValue('DDD',' ');
$document->setValue('TELEFONE',' ');
$document->setValue('ENDERECO','Inserir endereço completo com CEP');
$document->setValue('CNPJ','Inserir CNPJ da empresa');
$document->setValue('OBJETIVO','Inserir detalhamento dos serviços a serem prestados');
$document->setValue('FORMA_SERVICO','x');
$document->setValue('FORMA_PERIODO',' ');
$document->setValue('VIGENCIA_DETERMINADA','x');
$document->setValue('VIGENCIA_INICIO','01/01/2016');
$document->setValue('VIGENCIA_FIM','01/01/2017');
$document->setValue('VIGENCIA_INDETERMINADA',' ');
$document->setValue('VALOR','R$ 10,00');
$document->setValue('VIGENCIA_EXTENSO','DEZ REAIS');
$document->setValue('QTD_PARCELA','10');
//$document->setValue('QTD_PARCELA_EXTENSO','1º pagamento: emissão da nota fiscal em xx/xx/2016 e pagamento  em xx/xx/2016'."\n".'2º pagamento: emissão da nota fiscal em xx/xx/2016 e pagamento  em xx/xx/2016');
$document->save('CONTRATO.docx');
?>