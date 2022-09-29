<?php

define('GAME_ENDPOINT', 'https://pay.tokomini.net/api/');

function pricelist($category = false, $option = false) {
    $request = new HTTP_Request2();
    $request->setUrl('https://pay.tokomini.net/api/pricelist');
    $request->setMethod(HTTP_Request2::METHOD_GET);
    $request->setConfig(array(
        'follow_redirects' => TRUE
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

function mlbb_validator($player_id) {
    $request = new HTTP_Request2();
    $request->setUrl('https://pay.tokomini.net/api/id/mlbb/' . $player_id);
    $request->setMethod(HTTP_Request2::METHOD_GET);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Cookie' => 'csrf_cookie=71c8e0bb1e01ec9795299609e88ee996; sid=hitik5rnhc79p8cfqgb5ferteifgdn8k'
    ));
    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $data = json_decode($response->getBody());
            return $data->status;
        } else {
            return $response->getStatus() . ' ' . $response->getReasonPhrase();
        }
    } catch(HTTP_Request2_Exception $e) {
        return $e->getMessage();
    }
}