<HTML>
<HEAD><TITLE> EJ2-Conversion IP Decimal a Binario sin sprintf()</TITLE></HEAD>
<BODY>
<?php

function decToBin($num)
{
    $aux = '';

    while ($num > 0)
    {
        $aux = $num % 2 . $aux;
        $num = (int)($num / 2); 
    }

    while (strlen($aux) < 8)
        $aux = '0' . $aux;
    return ($aux);
}

$ip = "192.18.16.204";

function ipToBinary($ip)
{
    $num = 0;
    $len = strlen($ip);
    $i = 0;

    while ($i < $len)
    {
        if ($ip[$i] == '.')
        {
            print(decToBin($num));
            print(".");
            $num = 0;
        }
        $num = $num * 10 + (int)$ip[$i];
        $i++;
    }
    print(decToBin($num));
}
print ("<p>IP: <b>$ip</b></p>\n");
print ("IP en binario sin sprinf(): ");
ipToBinary($ip);

?>
</BODY>