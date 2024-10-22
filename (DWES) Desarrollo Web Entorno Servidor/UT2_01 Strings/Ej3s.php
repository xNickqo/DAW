<HTML>
<HEAD><TITLE> EJ3</TITLE></HEAD>
<BODY>
<?php

function getOctet($ip, $pos)
{
    $num = 0;
    $i = 0;
    $dotCount = 0;

    while ($i < strlen($ip)) 
    {
        if ($ip[$i] == '.') 
        {
            $dotCount++;
            if ($dotCount == $pos) 
                return $num;
            $num = 0;
        } 
        $num = $num * 10 + (int)$ip[$i];
        $i++;
    }
    if ($dotCount == $pos - 1)
        return $num;
    return null;
}

function getNetworkAddress($ip, $mask)
{
    $network = '';
    $i = 1;

    while ($i <= 4)
    {
        $ip_octet = getOctet($ip, $i);
        $mask_octet = getOctet($mask, $i);
        $network_octet = $ip_octet & $mask_octet;

        $network .= $network_octet;
        if ($i < 4)
            $network .= '.';

        $i++;
    }
    return $network;
}

function getBroadcast($ip, $mask)
{
    $broadcast = '';
    $i = 1;
    while ($i <= 4)
    {
        $ip_octet = getOctet($ip, $i);
        $mask_octet = getOctet($mask, $i);
        
        if ($mask_octet == 255)
            $broadcast_octet = $ip_octet;
        else if ($mask_octet == 0)
            $broadcast_octet = 255;
        else
        {
            $broadcast_octet = $ip_octet;

            if ($mask_octet < 255)
            {
                $broadcast_octet = $ip_octet;
                $host_bits = 255 - $mask_octet;
                $broadcast_octet = $broadcast_octet - (255 - $host_bits);
            }
        }
        
        $broadcast .= $broadcast_octet;
        if ($i < 4)
            $broadcast .= '.';

        $i++;
    }
    return $broadcast;
}

function getRange($network, $broadcast)
{
    $first = '';
    $last = '';
    $i = 1;

    while ($i <= 4)
    {
        $network_octet = getOctet($network, $i);
        $broadcast_octet = getOctet($broadcast, $i);

        if ($i == 4)
            $first .= ($network_octet + 1);
        else
            $first .= $network_octet;

        if ($i == 4)
            $last .= ($broadcast_octet - 1);
        else
            $last .= $broadcast_octet;

        if ($i < 4)
        {
            $first .= '.';
            $last .= '.';
        }

        $i++;
    }
    return [$first, $last];
}


$ip = "192.18.16.204";
$mask = "255.255.255.0";

$networkAdress = getNetworkAddress($ip, $mask);
$broadcastAdress = getBroadcast($ip, $mask);
list($first, $last) = getRange($networkAdress, $broadcastAdress);

print ("<p>IP: <b>$ip</b></p>\n");
print ("netwrk access: " . $networkAdress . "<br>");
print ("Broadcast access: " . $broadcastAdress . "<br>");
print ("Primera IP utilizable: " . $first . "<br>");
print ("Ultima IP utilizable: " . $last . "<br>");
?>
</BODY>
</HTML>