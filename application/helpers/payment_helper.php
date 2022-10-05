<?php

define('PAYMENT_TOKEN', 'Bearer DEV-eREVOvkfz8OpKNvCDDYUYWwSFVtCJA7sY7prUWb0');
define('PAYMENT_PRIVATEKEY', 'FAiTa-vocWL-Xh8mG-3Ngkc-cHiUM');
define('PAYMENT_ENDPOINT', 'https://tripay.co.id/api-sandbox/');

function instruction($code, $pay_code = false, $amount = false) {
    $request = new HTTP_Request2();
    $request->setUrl(PAYMENT_ENDPOINT . 'payment/instruction');
    $request->setMethod(HTTP_Request2::METHOD_GET);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Authorization' => PAYMENT_TOKEN,
        'Content-Type' => 'application/json'
    ));
    $request->setBody(json_encode(array(
        'code' => $code,
        'pay_code' => $pay_code,
        'amount' => $amount
    )));
    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $data = json_decode($response->getBody(), TRUE);
            if ($data['success'] === true) return $data['data'];
        } else {
            return $response->getStatus() . ' ' . $response->getReasonPhrase();
        }
    } catch(HTTP_Request2_Exception $e) {
        return $e->getMessage();
    }
}

function detail_payment($payment_id) {
    $request = new HTTP_Request2();
    $request->setUrl(PAYMENT_ENDPOINT . 'transaction/detail');
    $request->setMethod(HTTP_Request2::METHOD_GET);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Authorization' => PAYMENT_TOKEN,
        'Content-Type' => 'application/json'
    ));
    $request->setBody(json_encode(array(
        'reference' => $payment_id
    )));
    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $data = json_decode($response->getBody(), TRUE);
            if ($data['success'] === true) return $data['data'];
        } else {
            return $response->getStatus() . ' ' . $response->getReasonPhrase();
        }
    } catch(HTTP_Request2_Exception $e) {
        return $e->getMessage();
    }
}

function channel($code = false) {
    $request = new HTTP_Request2();
    $request->setUrl(PAYMENT_ENDPOINT . 'merchant/payment-channel');
    $request->setMethod(HTTP_Request2::METHOD_GET);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Authorization' => PAYMENT_TOKEN
    ));
    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $data = json_decode($response->getBody(), TRUE);
            if ($data['success'] === true) {
                $channel = $data['data'];
                if ($code) {
                    foreach ($data['data'] as $row) {
                        if ($row['code'] === $code) $channel = $row;
                    }
                }
                
                return $channel;
            }
        } else {
            return $response->getStatus() . ' ' . $response->getReasonPhrase();
        }
    } catch(HTTP_Request2_Exception $e) {
        return $e->getMessage();
    }
}

function create_payment($data) {
    $request = new HTTP_Request2();
    $request->setUrl(PAYMENT_ENDPOINT . 'transaction/create');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
        'Authorization' => PAYMENT_TOKEN
    ));
    $request->addPostParameter($data);
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

function payment_signature($merchantRef, $amount) {
    $merchantCode = 'T15747';
    return hash_hmac('sha256', $merchantCode.$merchantRef.$amount, PAYMENT_PRIVATEKEY);
}

function callback_signature($json) {
    return hash_hmac('sha256', $json, PAYMENT_PRIVATEKEY);
}