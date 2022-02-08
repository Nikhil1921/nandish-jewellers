<?php
// https://demo.hasthemes.com/corano-preview/corano/index.html
$curl_handle = curl_init();
curl_setopt($curl_handle,CURLOPT_URL, "https://nandish.in/sitemap");
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER, 0);
$result = curl_exec($curl_handle);
curl_close($curl_handle);