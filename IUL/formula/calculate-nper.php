<?php

function calculate_nper($interest, $payment, $loan){
	$nper=NPER($interest, $payment, $loan, 0);
	return ROUND(ABS($nper)/12,2);
}

function round_up ( $value, $precision ) { 
    $pow = pow ( 10, $precision ); 
    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
} 
function NPER($rate, $pmt, $pv, $fv = 0.0, $type = 0)
{
	$rate=round_up($rate/1200, 3);
	
	if (($rate == 0) && ($pmt != 0))
		$nper = (-($fv + $pv) / $pmt);
	elseif ($rate <= 0.0)
		return null;
	else {
		$tmp = ($pmt * (1.0 + $rate * $type) - $fv * $rate) /
				($pv * $rate + $pmt * (1.0 + $rate * $type));
		if ($tmp <= 0.0)
			return null;
		$nper = (log10($tmp) / log10(1.0 + $rate));
	}
	return (is_finite($nper) ? $nper: null);
}


function IPMT($rate, $per, $nper, $pv, $fv = 0.0, $type = 0)
{
	if (($per < 1) || ($per >= ($nper + 1)))
		return null;
	else {
		$pmt = $this->_calculate_pmt ($rate, $nper, $pv, $fv, $type);
		$ipmt = $this->_calculate_interest_part ($pv, $pmt, $rate, $per - 1);
		return (is_finite($ipmt) ? $ipmt: null);
	}
}

?>