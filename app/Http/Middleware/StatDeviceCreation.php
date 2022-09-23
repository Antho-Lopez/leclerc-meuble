<?php

namespace App\Http\Middleware;

use App\Models\StatDevice;
use Closure;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatDeviceCreation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(session()->get('already_came') != true){

            if($request->getPathInfo() == '/home/facebook'){
                $come_from = 'facebook';
            } elseif($request->getPathInfo() == '/home/instagram'){
                $come_from = 'instagram';
            } elseif($request->getPathInfo() == '/home/twitter'){
                $come_from = 'twitter';
            } elseif($request->getPathInfo() == '/home/sms'){
                $come_from = 'sms';
            } elseif($request->getPathInfo() == '/home/email'){
                $come_from = 'email';
            } elseif($request->getPathInfo() == '/home/landing'){
                $come_from = 'landing page';
            } elseif($request->getPathInfo() == '/home/qrcode'){
                $come_from = 'QRCode';
            } else {
                $come_from = 'sans pub';
            }



            if(Auth::user()){
                StatDevice::create([
                    'user_id' => Auth::user()->id,
                    'device_type' => Browser::deviceType(),
                    'browser_family' => Browser::browserFamily(),
                    'platform_family' => Browser::platformFamily(),
                    'device_family' => Browser::deviceFamily(),
                    'device_model' => Browser::deviceModel(),
                    'come_from' => $come_from,
                ]);
            } else {
                StatDevice::create([
                    'device_type' => Browser::deviceType(),
                    'browser_family' => Browser::browserFamily(),
                    'platform_family' => Browser::platformFamily(),
                    'device_family' => Browser::deviceFamily(),
                    'device_model' => Browser::deviceModel(),
                    'come_from' => $come_from,
                ]);
            }

        }
        $request->session()->put('already_came', true);

        return $next($request);
    }
}
