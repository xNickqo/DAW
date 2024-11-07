<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php

$ip = "192.18.16.204";

function ipToBinary($ip)
{
    $substrs = 0;
    $len = strlen($ip);
    $i = 0;

    while ($i < $len)
    {
        if ($ip[$i] == '.')
        {
            printf('%08b.', (int)$substrs);
            $substrs = 0;
        }
        $substrs = $substrs * 10 + (int)$ip[$i];
        $i++;
    }
    printf('%08b.', (int)$substrs);
}
print ("<p>IP: <b>$ip</b></p>\n");
print ("IP en binario: ");
ipToBinary($ip);

?>
</BODY>
</HTML>