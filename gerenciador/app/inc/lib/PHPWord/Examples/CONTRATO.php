<?php
require_once '../PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('PRESTACAO_SERVICO.docx');

$document->setValue('NUMERO_CONTRATO',' - ');
$document->setValue('RAZAO_SOCIAL', utf8_decode('Inserir razão social') );

$document->setValue('NOME_REPRESENTANTE', utf8_decode( 'Nome do representante legal' ) );
$document->setValue('RG_REPRESENTANTE', utf8_decode( 'RG do representante legal') ) ;
$document->setValue('NOME_CONTATO', utf8_decode( 'Nome do contato' ) );
$document->setValue('E-MAIL', utf8_decode( 'Endereço completo do contato' ) );
$document->setValue('DDD', utf8_decode( ' ' ) );
$document->setValue('TELEFONE', utf8_decode( ' ' ) );
$document->setValue('ENDERECO', utf8_decode( 'Inserir endereço completo com CEP' ) );
$document->setValue('CNPJ', utf8_decode( 'Inserir CNPJ da empresa' ) );
$document->setValue('OBJETIVO', utf8_decode( 'Inserir detalhamento dos serviços a serem prestados' ) );
$document->setValue('VIGENCIA_DETERMINADA','x');
$document->setValue('VIGENCIA_INICIO','01/01/2016');
$document->setValue('VIGENCIA_FIM','01/01/2017');
$document->setValue('VIGENCIA_INDETERMINADA',' ');
$document->setValue('VALOR','R$ 10,00');
$document->setValue('VALOR_EXTENSO','DEZ REAIS');
$document->setValue('QTD_PARCELA','10');
$document->setValue('QTD_PARCELA_EXTENSO',utf8_decode('1º pagamento: emissão da nota fiscal em xx/xx/2016 e pagamento  em xx/xx/2016'."\n\r".'2º pagamento: emissão da nota fiscal em xx/xx/2016 e pagamento  em xx/xx/2016'));
$document->setValue('FORMA_SERVICO',utf8_decode( 'x' ) );
$document->setValue('FORMA_PERIODO',utf8_decode( ' ' ) );
$document->save('CONTRATO' .date("YmdHis") . '.docx');
?>