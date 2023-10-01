<?php

namespace App\Http\Controllers;

use App\Http\Requests\CredidCardPost;

class CreditCardController extends Controller
{
    public function verification(CredidCardPost $request)
    {
        //validates data
        $cardInfo = $request->validated();

        //validates card and type and cvv
        $cvvLen = strlen((string)$cardInfo['cvv']);
        if (($cardInfo['type'] == 'visa' || $cardInfo['type'] == 'mc') && $cvvLen != 3) {

            return response('cvv incorrect', 422)->header('Content-Type', 'application/json');
        }
        //validates pan for american express
        if ($cardInfo['type'] == 'am') {

            if ($cvvLen != 4) {
                return response('cvv incorrect', 422)->header('Content-Type', 'application/json');
            }
            $panNumber = ((string)$cardInfo['pan']);
            $panIntit = $panNumber[0] . $panNumber[1];

            if ($panIntit != '34' && $panIntit != '37') {
                return response('incorrect pan', 422)->header('Content-Type', 'application/json');
            }
        }
        //validates experiration date of card
        if ($cardInfo['year'] == date('Y') && $cardInfo['month'] < intval(date('m'))) {
            return response('card expired', 422)->header('Content-Type', 'application/json');
        }


        //luhn algoritm
        //convert pan int int array
        $panSum = 0;
        $panArray  = array_map('intval', str_split($cardInfo['pan']));
        //run array from right to left starting in second position
        for ($i = count($panArray) - 2; $i >= 0; $i = $i - 2) {
            if ($panArray[$i] > 4) {
                $panArray[$i] = $panArray[$i] + $panArray[$i] - 9;
            } else {
                $panArray[$i] = $panArray[$i] + $panArray[$i];
            }
        }
        //sum total value of array
        $panSum = array_sum($panArray);
        //if mod 10 different than 0 - pan is invalid
        if ($panSum % 10 != 0) {
            return response('pan is invalid', 422)->header('Content-Type', 'application/json');
        }

        return response('card info correct', 200)->header('Content-Type', 'application/json');
    }
}
