<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Stripecallback;
use  Stripe;
class StripeController extends Controller
{
    /**
     * payment view
     */
    public function handleGet()
    {
        return view('stripe');
    }

    public function testing()
    {
        return view('testing');
    }
    public function client()
    {
        return view('testing');
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * 150,
            "currency" => "inr",
            "source" => $request->stripeToken,
            "description" => "Making test payment."
        ]);

        Session::flash('success', 'Payment has been successfully processed.');

        return back();
    }

    public function stripeOauthCallback(Request $request){
        
        // Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51M0OhNKNJp9ldcaEn0QfTqXyKFaFe0LSa25XcZBHprb0SM2zTbPLDNQfGoyTW45Lu2UBM1C01XAtRhvwjwMMEaSi00ker8bpeN');

        $response = \Stripe\OAuth::token([
        'grant_type' => 'authorization_code',
        'code' => $request->code,
        ]);

        // Access the connected account id in the response
        $connected_account_id = $response->stripe_user_id;
        

        
        $data = new Stripecallback;
        $data->stripe_customer_id=$request->code;
        $data->stripe_account_id= $connected_account_id;
        $data->save();

        print_r("Account id saved successfully"); exit;
    
 
    }
}
