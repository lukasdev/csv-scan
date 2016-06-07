<?php
    require 'vendor/autoload.php';
    use \League\Csv\Reader;

    //instancia o cliente HTTP Guzzle
    $client = new \GuzzleHttp\Client();

    //abre e itera o arquivo CSV:
    $csv = Reader::createFromPath($argv[1]);
    $res = $csv->fetchAll();
    foreach ($res as $csvRow) {
        try {
            //envia um request http options
            $httpResponse = $client->options($csvRow[0]);

            //inspeciona o código da resposta
            if ($httpResponse->getStatusCode() >= 400) {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            //exibe urls erradas
            echo $csvRow[0].PHP_EOL;
        }
    }