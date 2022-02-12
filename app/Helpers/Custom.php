<?php

if (!function_exists('only_numbers')) {
	function only_numbers($str)
	{
		return preg_replace('/[^0-9]/', '', $str);
	}
}

if ( ! function_exists('mask()'))
{
	function mask($mask, $str) {
		$str = str_replace(' ', '', $str);

		for($i = 0; $i < strlen($str); $i++) {
			$mask[strpos($mask, '#')] = $str[$i];
		}

		return $mask;
	}
}

if (!function_exists('currency')) {
	function currency($expression)
	{
		return 'R$ '.number_format($expression, 2, ',', '.');
	}
}

if (!function_exists('calc_interest'))
{
	function calc_interest($price, $installments, $rate = 0)
	{
		if ($rate == 0) {
			return $price / $installments;
		}
		
		$I = $rate / 100.00;
		return $price * $I * pow((1 + $I), $installments) / (pow((1 + $I), $installments) - 1);
	}
}

if (!function_exists('get_order_status')) {
	function get_order_status($status)
	{
		switch ($status) {
			case 'authorized':
				return strval(\App\Enums\OrderStatus::Authorized);
				break;
			case 'waiting_payment':
				return strval(\App\Enums\OrderStatus::WaitingPayment);
				break;
			case 'paid':
				return strval(\App\Enums\OrderStatus::Paid);
				break;
			
			default:
				return false;
				break;
		}
	}
}

if (!function_exists('get_order_payment_method')) {
	function get_order_payment_method($payment_method)
	{
		switch ($payment_method) {
			case 0:
				return strval(\App\Enums\OrderShippingMethod::Local);
				break;
			case 1:
				return strval(\App\Enums\OrderShippingMethod::Pac);
				break;
			case 2:
				return strval(\App\Enums\OrderShippingMethod::Sedex);
				break;
			case 3:
				return strval(\App\Enums\OrderShippingMethod::Jadlog);
				break;
			case 16:
				return strval(\App\Enums\OrderShippingMethod::Azul);
				break;
			
			default:
				return false;
				break;
		}
	}
}