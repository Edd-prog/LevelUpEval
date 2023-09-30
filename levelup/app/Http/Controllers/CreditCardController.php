<?php

namespace App\Http\Controllers;

use App\Http\Requests\CredidCardPost;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    public function verification(CredidCardPost $request)
    {
        //dd($request);
        $cardInfo = $request->validated();


        $cvvLen = strlen((string)$cardInfo['cvv']);
        if (($cardInfo['type'] == 'visa' || $cardInfo['type'] == 'mc') && $cvvLen != 3) {

            return response('cvv incorrect', 422)->header('Content-Type', 'application/json');
        }
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

        //dd(intval(date('m')));
        if ($cardInfo['year'] == date('Y') && $cardInfo['month'] < intval(date('m'))) {
            return response('card expired', 422)->header('Content-Type', 'application/json');
        }



        return response('card info correct', 200)->header('Content-Type', 'application/json');
    }


    /*
        The expiry date of the credit card (year and month) must be AFTER present time
        The CVV (security code) of the credit card must be exactly 3 digits long
        Unless it’s an American Express card, in which case the CVV must be exactly 4 digits long
       
        American Express are cards whose PAN (card numbers) starts with either “34” or “37”


        The PAN (card number) is between 16 and 19 digits long
        Last digit of the PAN (card number) is checked using Luhn’s algorithm
    */
}
