<?php

use App\Order;
use Carbon\Carbon;

function presentPrice($price)
{
    return number_format($price);
}

function presentOldPrice($old_price)
{
    return number_format($old_price);
}

function presentDate($date)
{
    return Carbon::parse($date)->format('d.m.Y');
}

?>
