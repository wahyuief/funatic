<?php
use Hashids\Hashids;

function unique_id($mode = false, $length = 16) {
    if ($mode === 'symbol') return substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@#$%^&*()_+{}|:<>?-=[];,.", $length)), 0, $length);
    if ($mode === 'uuid') return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
    if ($length) return substr(bin2hex(random_bytes($length)), 0, $length);
}

function wah_encode($value) {
    if (!$value) return false;
    $ci = &get_instance();
    $hashids = new Hashids($ci->config->item('encryption_key'));
    $value = $hashids->encodeHex($value . 'aaa' . time() * 60 * 60 * 24);
    $key = hash('sha256', $ci->config->item('encryption_key'), true);
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $crypttext = '';
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($value, $i, 1));
        if ($j == $keyLen) $j = 0;
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
    }
    return str_rot13($crypttext);
}

function wah_decode($value) {
    if (!$value) return false;
    $ci = &get_instance();
    $key = hash('sha256', $ci->config->item('encryption_key'), true);
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $decrypttext = '';
    for ($i = 0; $i < $strLen; $i += 2) {
        $ordStr = hexdec(base_convert(strrev(substr(str_rot13($value), $i, 2)), 36, 16));
        if ($j == $keyLen) $j = 0;
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $decrypttext .= chr($ordStr - $ordKey);
    }

    $hashids = new Hashids($ci->config->item('encryption_key'));
    $decodedstr = explode('aaa', $hashids->decodeHex($decrypttext));
    if (time() > $decodedstr[1]) show_error('Your token is no longer valid.');
    return $decodedstr[0];
}

function rupiah($value) {
	return "Rp" . number_format($value, 0, ',', '.');
}

function input_get($value) {
    $ci = &get_instance();
    return htmlspecialchars(htmlentities(strip_tags($ci->input->get($value))), ENT_QUOTES, 'UTF-8');
}

function input_post($value) {
    $ci = &get_instance();
    return htmlspecialchars(htmlentities(strip_tags($ci->input->post($value))), ENT_QUOTES, 'UTF-8');
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}