<?php

define('GAME_APIKEY', 'dev-fdbbcfa0-495a-11ed-a213-cfbbb6e1a150');
define('GAME_USERNAME', 'zesefaDbXEMg');
define('GAME_ENDPOINT', 'https://api.digiflazz.com/v1/');

function pricelist($category = false, $brand = false) {
    $request = new HTTP_Request2();
    $request->setUrl(GAME_ENDPOINT . 'price-list');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Content-Type' => 'application/json'
    ));
    $reqdata['cmd'] = 'prepaid';
    $reqdata['username'] = GAME_USERNAME;
    $reqdata['sign'] = md5(GAME_USERNAME . GAME_APIKEY . 'pricelist');
    $request->setBody(json_encode($reqdata));
    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $data = json_decode($response->getBody(), TRUE);
            $pricelist = array();
            foreach ($data['data'] as $krow => $vrow) {
                unset($vrow['desc']);
                if ($category && $brand) {
                    if ($vrow['category'] === $category && strpos($vrow['brand'], $brand) !== false) $pricelist[] = $vrow;
                } else if ($category && !$brand) {
                    if ($vrow['category'] === $category) {
                        $optname[] = $vrow['brand'];
                        $pricelist = array_keys(array_count_values($optname));
                    }
                } else {
                    $catname[] = $vrow['category'];
                    $pricelist = array_keys(array_count_values($catname));
                }
            }
            return json_encode($pricelist);
        } else {
            return $response->getStatus() . ' ' . $response->getReasonPhrase();
        }
    } catch(HTTP_Request2_Exception $e) {
        return $e->getMessage();
    }
}

function game_transaction($variation_code, $customer_id, $no_invoice) {
    $request = new HTTP_Request2();
    $request->setUrl(GAME_ENDPOINT . 'transaction');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Content-Type' => 'application/json'
    ));
    $reqdata['username'] = GAME_APIKEY;
    $reqdata['buyer_sku_code'] = $variation_code;
    $reqdata['customer_no'] = $customer_id;
    $reqdata['ref_id'] = $no_invoice;
    $reqdata['sign'] = md5(GAME_USERNAME . GAME_APIKEY . $no_invoice);
    $reqdata['testing'] = true;
    $request->setBody(json_encode($reqdata));
    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            return json_decode($response->getBody(), TRUE);
        }
        else {
            return $response->getStatus() . ' ' . $response->getReasonPhrase();
        }
    }
        catch(HTTP_Request2_Exception $e) {
        return $e->getMessage();
    }
}

function gameid_validator($player_id, $slug) {
    $request = new HTTP_Request2();
    $request->setUrl('https://apivouchergame.com/api/check-game-id/' . $slug);
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Authorization' => 'Bearer 192|OgXkZZs1LT4QsKfHhNqJC2Kmn9sKJnDg6BD2XvXM',
        'Content-Type' => 'application/json'
    ));

    if ($slug === 'mobile-legend') {
        $zoneid = (int)substr($player_id, -4);
        $userid = (int)str_replace($zoneid, '', $player_id);
        $request->setBody('{"uid": "'.$userid.'", "zid": "'.$zoneid.'"}');
    } else {
        $request->setBody('{"uid": "'.$player_id.'"}');
    }

    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $data = json_decode($response->getBody());
            return $data;
        } else {
            return $response->getStatus() . ' ' . $response->getReasonPhrase();
        }
    } catch(HTTP_Request2_Exception $e) {
        return $e->getMessage();
    }
}