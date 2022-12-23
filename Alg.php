<?php
class  x {

protected function luhn($number)
{
    $number = 4000001234567899;
    $number = (string)$number;

    if (!ctype_digit($number)) {

        return FALSE;
    }

    $length = strlen($number);

    $checksum = 0;

    for ($i = $length - 1; $i >= 0; $i -= 2) {

        $checksum += substr($number, $i, 1);
    }

    for ($i = $length - 2; $i >= 0; $i -= 2) {

        $double = substr($number, $i, 1) * 2;

        $checksum += ($double >= 10) ? ($double - 9) : $double;
    }

    return ($checksum % 10 === 0);
}


protected function ValidCreditcard($number)
{
    $card_array = array(
        'default' => array(
            'length' => '13,14,15,16,17,18,19',
            'prefix' => '',
            'luhn' => TRUE,
        ),
        'daron' => array(
            'length' => '14',
            'prefix' => '14|81|99[0-5]',
            'luhn' => TRUE,
        ),

        'maestro' => array(
            'length' => '16,18',
            'prefix' => '50(?:20|38)|6(?:304|759)',
            'luhn' => TRUE,
        ),
        'mastercard' => array(
            'length' => '16',
            'prefix' => '5[1-5]',
            'luhn' => TRUE,
        ),
        'visa' => array(
            'length' => '13,16',
            'prefix' => '4',
            'luhn' => TRUE,
        ),
    );

    if (($number = preg_replace('/\D+/', '', $number)) === '')
        return FALSE;

    $type = 'default';

    $cards = $card_array;

    $type = strtolower($type);

    if (!isset($cards[$type]))
        return FALSE;

    $length = strlen($number);

    if (!in_array($length, preg_split('/\D+/', $cards[$type]['length'])))
        return FALSE;

    if (!preg_match('/^' . $cards[$type]['prefix'] . '/', $number))
        return FALSE;

    if ($cards[$type]['luhn'] == FALSE)
        return TRUE;

    return $this->luhn($number);

        echo ($type);
        echo ($number);
        echo ($cards);

    
}
}
?>