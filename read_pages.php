<?php

require_once __DIR__ . '/libs/vendor/autoload.php';
require_once __DIR__ . '/libs/vendor/koorosawa/Cipaustralia.php';
use PhpQuery\PhpQuery,
    Koorosawa\Cipaustralia;


$page = 0;
$trademarks = [];
$trademarksCount = 0;

while (true){
    $ipaustralia = new Cipaustralia('https://search.ipaustralia.gov.au/trademarks/search/result?s=3bb39d82-f5c4-4766-9549-91c4456ad587&p=' . $page, new PhpQuery);
    $ipaustralia->setTrademarks('#resultsTable tbody tr');

    $trademarks = array_merge($ipaustralia->getTrademarksArray(), $trademarks);

    $trademarksCount += $ipaustralia->getTrademarksCount();
    if($ipaustralia->getTrademarksCount() == 0)
        break;
    $page++;
    print_r( "Read page: #" . $page . "\r\n");
}
print_r( "Total: " . $trademarksCount . "\r\n");
