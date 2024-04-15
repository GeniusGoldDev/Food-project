<?php
use Carbon\CarbonInterval;

/**
 * @param $t1
 * @param $t2
 */
function timeStrampDiffFormatted($t1, $t2)
{
    $days = $t1->diffInDays($t2);
    $hours = $t1->diffInHours($t2->subDays($days));
    $minutes = $t1->diffInMinutes($t2->subHours($hours));
    $seconds = $t1->diffInSeconds($t2->subMinutes($minutes));
    return CarbonInterval::days($days)->hours($hours)->minutes($minutes)->seconds($seconds)->forHumans();
};

/**
 * @param $t1
 * @param $t2
 * @return mixed
 */
function diffInMins($t1, $t2)
{
    $minutes = $t1->diffInMinutes($t2);
    return $minutes;
}

/**
 * @param $string
 * @return mixed
 */
function returnAcronym($string)
{
    $words = explode(' ', "$string");
    $acronym = '';
    foreach ($words as $w) {
        if (isset($w[0])) {
            $acronym .= $w[0];
        }
    }
    $firstTwoChars = strtoupper(mb_substr($acronym, 0, 2, 'UTF-8'));
    return $firstTwoChars;
}

/**
 * @param $collection
 */
function storeAvgRating($collection)
{
    $rating = number_format((float) $collection->avg('rating_store'), 1, '.', '');
    return str_replace('.0', '', (string) number_format($rating, 1, '.', ''));
}

/**
 * @param $collection
 */
function deliveryAvgRating($collection)
{
    $rating = number_format((float) $collection->avg('rating_delivery'), 1, '.', '');
    return str_replace('.0', '', (string) number_format($rating, 1, '.', ''));
}

/**
 * @return mixed
 */
function ratingColorClass($rating)
{
    $rating = (float) $rating;
    $classColor = 'rating-green';
    if ($rating <= 3) {
        $classColor = 'rating-orange';
    }
    if ($rating <= 2) {
        $classColor = 'rating-red';
    }

    return $classColor;
}
