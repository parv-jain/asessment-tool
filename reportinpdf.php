<?php

require 'pdfcrowd.php';

try {
    $url=$_SERVER['HTTP_REFERER'];
    $client = new Pdfcrowd("parv16", "f9e04619840a28de0a9bd8f362b7ccbd");
    $pdf = $client->convertURI($url);

    header("Content-Type: application/pdf");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: inline; filename=\"mydomain.pdf\"");

    echo $pdf;

}
catch(PdfcrowdException $why) {
    echo "Can't create PDF: ".$why."\n";
}

?>
