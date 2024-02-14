<?php 
downloadUrlToFile($_GET['url'],$_GET['name']);
function downloadUrlToFile($url, $outFileName)
{   
    if(is_file($url)) {
        copy($url, $outFileName); 
    } else {
        $options = array(
          CURLOPT_FILE    => fopen($outFileName, 'w'),
          CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
          CURLOPT_URL     => $url
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }
}

    
