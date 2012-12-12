<?php

namespace VR\Search\Http;

class Curl
{
    public static function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept-Charset: utf-8;q=0.7,*;q=0.7',
        ));
        $html = curl_exec($ch);

        return mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
    }
}