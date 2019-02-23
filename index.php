<?php
    
    function iptocountry($ip) {
        $numbers = preg_split( "/\./", $ip);
        include("ip_files/".$numbers[0].".php");
        $code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);
        foreach($ranges as $key => $value){
            if($key<=$code){
                if($ranges[$key][0]>=$code){$two_letter_country_code=$ranges[$key][1];break;}
                }
        }
        if ($two_letter_country_code==""){$two_letter_country_code="unkown";}
        return $two_letter_country_code;
    }

    
    
    


    if (!empty($http_client_ip = $_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $http_client_ip;
    }elseif (!empty($http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'])) {
        # code...
        $ip_address = $http_x_forwarded_for;
    }else{
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    
    $ip_address;
    $two_letter_country_code = iptocountry($ip_address);
    //include("ip_files/countries.php");
    //$country_name=$countries[$two_letter_country_code][1];
    //print "Country name: $country_name<br>";
    
    $handle = fopen('visitors.txt', 'a');
        $date = date('Y, M, d @ H:i:s', time());

    fwrite($handle, $ip_address."   ".$two_letter_country_code."  ".$date. "\n");

    fclose($handle);

    header('location:index.html');
    
    
?>