<?php

define('GAME_APIKEY', '');
define('GAME_ENDPOINT', 'https://pay.tokomini.net/api/');

function pricelist($category = false, $option = false) {
    $request = new HTTP_Request2();
    $request->setUrl(GAME_ENDPOINT . 'pricelist');
    $request->setMethod(HTTP_Request2::METHOD_GET);
    $request->setConfig(array(
        'follow_redirects' => TRUE,
        'ssl_verify_peer' => FALSE,
        'ssl_verify_host' => FALSE
    ));
    $request->setHeader(array(
        'Cookie' => 'csrf_cookie=71c8e0bb1e01ec9795299609e88ee996; sid=hitik5rnhc79p8cfqgb5ferteifgdn8k'
    ));
    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $data = json_decode($response->getBody(), TRUE);
            if ($data['status'] === true) {
                $pricelist = array();
                foreach ($data['data'] as $krow => $vrow) {
                    unset($vrow['product_desc']);
                    if ($category && $option) {
                        if ($vrow['product_cat'] === $category && strpos($vrow['product_opt'], $option) !== false) $pricelist[] = $vrow;
                    } else if ($category && !$option) {
                        if ($vrow['product_cat'] === $category) {
                            $optname[] = $vrow['product_opt'];
                            $pricelist = array_keys(array_count_values($optname));
                        }
                    } else {
                        $catname[] = $vrow['product_cat'];
                        $pricelist = array_keys(array_count_values($catname));
                    }
                }
                return json_encode($pricelist);
            }
        } else {
            return $response->getStatus() . ' ' . $response->getReasonPhrase();
        }
    } catch(HTTP_Request2_Exception $e) {
        return $e->getMessage();
    }
}

function detail_transaction($transaction_id) {
    $request = new HTTP_Request2();
    $request->setUrl(GAME_ENDPOINT . 'v3');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Content-Type' => 'application/json'
    ));
    $reqdata['apikey'] = GAME_APIKEY;
    $reqdata['command'] = 'order';
    $reqdata['idtrx'] = $transaction_id;
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

function order_produk($data) {
    $request = new HTTP_Request2();
    $request->setUrl(GAME_ENDPOINT . 'v3');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Content-Type' => 'application/json'
    ));
    $reqdata['apikey'] = GAME_APIKEY;
    $reqdata['command'] = 'order';
    $reqdata['data'] = array($data);
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

function mlbb_validator($player_id) {
    $request = new HTTP_Request2();
    $request->setUrl('https://apivouchergame.com/api/check-game-id/mobile-legend');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Authorization' => 'Bearer 192|OgXkZZs1LT4QsKfHhNqJC2Kmn9sKJnDg6BD2XvXM',
        'Content-Type' => 'application/json'
    ));
    $zoneid = (int)substr($player_id, -4);
    $userid = (int)str_replace($zoneid, '', $player_id);
    $request->setBody('{"uid": '.$userid.', "zid": '.$zoneid.'}');
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