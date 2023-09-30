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


        return response('card info correct', 200)->header('Content-Type', 'application/json');
    }
}
