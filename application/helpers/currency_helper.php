<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function formatMoney($number, $fractional=false) {
	if($number == 0)
		return "-";
	else {
		if ($fractional) {
			$number = sprintf('%.2f', $number);
		}
		while (true) {
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1.$2', $number);
			if ($replaced != $number) {
				$number = $replaced;
			} else {
				break;
			}
		}
		return $number;
	}
}

/* End of file currency_helper.php */
/* Location: ./application/helpers/currency_helper.php */