<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class BillingController extends Controller
{
    // Billing
    public function billing (Request $request)
    {
        $plans = Plan::get();
        return view('settings.billing', compact('plans'));
    }

    public function billing_save (Request $request)
    {
        $user = auth()->user();

        try 
        {
            if ($user->subscribed('main'))
            {
                // Update credit card
                $user->updateDefaultPaymentMethod($request->payment_method);
                // if ($request->plan == 'basic') $new_plan = 'price_HKhESmW1dYCEyD';
                // else if ($request->plan == 'plus') $new_plan = 'price_HKkI9xlL6vSnSW';
                // else if ($request->plan == 'premium') $new_plan = 'price_HKkJHqA9dh5DVR';
                // $plan = Plan::where('name', '=', $request->plan);
            }
            else 
            {
                $new_plan = 'price_HKhESmW1dYCEyD';
                if ($request->plan == 'basic') $new_plan = 'price_HKhESmW1dYCEyD';
                else if ($request->plan == 'plus') $new_plan = 'price_HKkI9xlL6vSnSW';
                else if ($request->plan == 'premium') $new_plan = 'price_HKkJHqA9dh5DVR';

                $plan = Plan::where('name', '=', $request->plan)->first();
                $user->plan_id = $plan->id;
                $user->trial_ends_at = null; // End trial
                $user->save();
                // Create new subscription
                $user->newSubscription('main', $new_plan)->create($request->payment_method);
            }
        }
        catch(Exception $e)
        {
            return back()->with(['alert' => 'Something went wrong submitting your billing info.', 'alert_type' => 'error']);
        }

        return back()->with(['alert' => 'Successfully updated your billing info.', 'alert_type' => 'success']);
    }

    public function switch_plan (Request $request)
    {
        $plan = Plan::where('name', '=', $request->plan)->first();
        $user = auth()->user();

        try
        {
            if ($request->plan == 'basic') $new_plan = 'price_HKhESmW1dYCEyD';
            else if ($request->plan == 'plus') $new_plan = 'price_HKkI9xlL6vSnSW';
            else if ($request->plan == 'premium') $new_plan = 'price_HKkJHqA9dh5DVR';
            $user->subscription('main')->swap($new_plan);
            $user->plan_id = $plan->id;
            $user->save();
        }
        catch(Exception $e)
        {
            return back()->with(['alert' => 'Sorry, there was a problem updating your plan', 'alert_type' => 'error']);
        }

        return back()->with(['alert' => 'Your subscription plan has been updated', 'alert_type' => 'success']);
    }

    public function cancel (Request $request)
    {

    }
}
