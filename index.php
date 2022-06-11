<?php 

require __DIR__. '/vendor/autoload.php';

use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

//Instancia principal do payload pix
$obPayload = (new Payload)->setPixKey('')  //Chave pix
                        ->setDescription("") //Descrição do pix
                        ->setMerchantName("") // Nome dequem vai receber
                        ->setMerchantCity("") //Cidade de quem vai receber
                        ->setAmount() // Valor pago
                        ->setTxId('');  //Identificação do pix

$payloadQrCode = $obPayload->getPayload();

//QR Code
$obQrCode = new QrCode($payloadQrCode);

//Imagem do QrCode
$image = (new Output\Png)->output($obQrCode, 400);

// header('Content-Type: image/png');
// echo $image;

?>

<h1>QR CODE PIX</h1>
<br>
<img src="data:image/png;base64,<?=base64_encode($image)?>">
<br><br>
Código do pix: <br>
<strong><?=$payloadQrCode?></strong>