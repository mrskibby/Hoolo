<?php
namespace App\Http\Controllers;

use App\Genral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class GenralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('site-settings.genral-settings'), 403, 'User does not have the right permissions.');

        $row = Genral::first();

        $env_files = ['APP_NAME' => env('APP_NAME')];

        return view("admin.genral.edit", compact("row", "env_files"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        abort_if(!auth()->user()->can('site-settings.genral-settings'), 403, 'User does not have the right permissions.');

        $input = array_filter($request->all());

        $active = @file_get_contents(public_path() . '/config.txt');

        if (!$active) {
            $putS = 1;
            file_put_contents(public_path() . '/config.txt', $putS);
        }

        $d = \Request::getHost();

        $domain = str_replace("www.", "", $d);

        

        if ($domain == 'localhost' || strstr($domain, '.test') || strstr($domain, '192.168.') || strstr($domain, 'mediacity.co.in')) {
            return $this->verifiedupdate($input, $request);
        } else {

            support_check();

            $token = file_exists(storage_path() . '/app/keys/license.json') && file_get_contents(storage_path() . '/app/keys/license.json') != null ? file_get_contents(storage_path() . '/app/keys/license.json') : '';
        
            $token = json_decode($token);
        
            if($token != ''){
                $token = $token->token;
            }

            $ch = curl_init();
            $options = array(
                CURLOPT_URL => "https://mediacity.co.in/purchase/public/api/check/$domain",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    "Authorization: Bearer " . $token,
                ),
            );

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            curl_setopt_array($ch, $options);
            $response = curl_exec($ch);

            if (curl_errno($ch) > 0) {
                $message = __("Error connecting to API.");
                return back()->with('delete', $message);
            }
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($responseCode == 200) {
                $body = json_decode($response);
                return $this->verifiedupdate($input, $request);
            } else {
                $message = __("Failed");
                $putS = 0;
                @file_put_contents(public_path() . '/config.txt', $putS);
                return back();
            }
        }

    }

    public function verifiedupdate($input, $request)
    {

        abort_if(!auth()->user()->can('site-settings.genral-settings'), 403, 'User does not have the right permissions.');

        $cat = Genral::first();

        $env_keys_save = DotenvEditor::setKeys([
            'APP_NAME' => $request->APP_NAME,
            'APP_URL' => $request->APP_URL,
            'NOCAPTCHA_SECRET' => $request->NOCAPTCHA_SECRET,
            'NOCAPTCHA_SITEKEY' => $request->NOCAPTCHA_SITEKEY,
            'OPEN_EXCHANGE_RATE_KEY' => $request->OPEN_EXCHANGE_RATE_KEY,
            'APP_DEBUG' => isset($request->APP_DEBUG) ? "true" : "false",
            'COD_ENABLE' => isset($request->COD_ENABLE) ? "1" : "0",
            'ENABLE_PRELOADER' => isset($request->ENABLE_PRELOADER) ? "1" : "0",
            'TIMEZONE' => $request->TIMEZONE,
            'MAILCHIMP_APIKEY' => $request->MAILCHIMP_APIKEY,
            'MAILCHIMP_LIST_ID' => $request->MAILCHIMP_LIST_ID,
            'HIDE_SIDEBAR' => $request->HIDE_SIDEBAR ? 1 : 0,
            'GOOGLE_TAG_MANAGER_ENABLED' => $request->GOOGLE_TAG_MANAGER_ENABLED ? "true" : "false",
            'GOOGLE_TAG_MANAGER_ID' => $request->GOOGLE_TAG_MANAGER_ID,
            'PRICE_DISPLAY_FORMAT' => $request->PRICE_DISPLAY_FORMAT ? 'comma' : 'decimal',
            'SHOW_IMAGE_INSTEAD_COLOR' => $request->SHOW_IMAGE_INSTEAD_COLOR ? 'true' : 'false'
        ]);

        $env_keys_save->save();

       
        if ($request->logo != null) {

            
            if(strstr($request->logo, '.png') || strstr($request->logo, '.jpg') || strstr($request->logo, '.jpeg') || strstr($request->logo, '.webp') || strstr($request->logo, '.gif')){

                // if ($cat->logo != '' && file_exists(public_path() . '/images/genral/' . $cat->logo)) {
                //     unlink(public_path() . '/images/genral/' . $cat->logo);
                // }

                $input['logo'] = $request->logo;

            }else{
                return back()->withInput()->withErrors([
                    'Invalid image type'
                ]);
            }

        }

        if ($request->fevicon != null) {

            $input['fevicon'] = $request->fevicon;


            if(strstr($request->fevicon, '.png') || strstr($request->fevicon, '.jpg') || strstr($request->fevicon, '.jpeg') || strstr($request->fevicon, '.webp') || strstr($request->fevicon, '.ico')){

                if ($cat->fevicon != '' && file_exists(public_path() . '/images/genral/' . $cat->fevicon)) {
                    unlink(public_path() . '/images/genral/' . $cat->fevicon);
                }

            }else{
                return back()->withInput()->withErrors([
                    'Invalid favicon type'
                ]);
            }
 
        }

        if (isset($request->right_click)) {
            $input['right_click'] = '1';
        } else {
            $input['right_click'] = '0';
        }

        if (isset($request->captcha_enable)) {
            $input['captcha_enable'] = '1';
        } else {
            $input['captcha_enable'] = '0';
        }

        if (isset($request->inspect)) {
            $input['inspect'] = '1';
        } else {
            $input['inspect'] = '0';
        }

        if (isset($request->login)) {
            $input['login'] = '1';
        } else {
            $input['login'] = '0';
        }

        if (isset($request->guest_login)) {
            $input['guest_login'] = '1';
        } else {
            $input['guest_login'] = '0';
        }

        if (isset($request->vendor_enable)) {
            $input['vendor_enable'] = 1;
        } else {
            $input['vendor_enable'] = 0;
        }

        if (isset($request->email_verify_enable)) {
            $input['email_verify_enable'] = 1;
        } else {
            $input['email_verify_enable'] = 0;
        }

        if ($request->file('preloader')) {
            $dir = 'images/preloader';
            $leave_files = array('index.php');

            foreach (glob("$dir/*") as $file2) {
                if (!in_array(basename($file2), $leave_files)) {
                    unlink($file2);
                }
            }

            $image = $request->file('preloader');
            $img = Image::make($image->path());
            $preloader = 'preloader.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/preloader');
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($destinationPath . '/' . $preloader);
        }

        $input['cart_amount'] = $request->cart_amount ?? 0;

        $cat->update($input);

        if (isset($request->ENABLE_SELLER_SUBS_SYSTEM)) {

            $this->verifyPurchase();

        } else {

            $env_keys_save = DotenvEditor::setKeys([
                'ENABLE_SELLER_SUBS_SYSTEM' => 0,
            ]);

            $env_keys_save->save();

        }

        notify()->success("Genral Setting Has Been Updated !");
        return back();

    }

    public function verifyPurchase()
    {

        $domain = str_replace("www.", "", \Request::getHost());

        if ($domain == 'localhost' || strstr($domain, '.test') || strstr($domain, '192.168.') || strstr($domain, 'mediacity.co.in')) {

            $env_keys_save = DotenvEditor::setKeys([
                'ENABLE_SELLER_SUBS_SYSTEM' => 1,
            ]);

            $env_keys_save->save();
            return back();
        }

        if (extended_license() != true) {
            request()->validate([
                'purchase_code' => 'required',
            ]);
        }

        

        $code = request()->purchase_code;

        $personalToken = "inNy83FTjV2CTPqvNdPGRr2mAJ0raPC4";

        if (!preg_match("/^(\w{8})-((\w{4})-){3}(\w{12})$/", $code)) {
            //throw new Exception("Invalid code");
            $message = __("Invalid Purchase Code");
            return back()->withErrors($message)->withInput();
        }

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => "https://api.envato.com/v3/market/author/sale?code={$code}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,

            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$personalToken}",
            ),
        ));

        // Send the request with warnings supressed
        $response = curl_exec($ch);

        // Handle connection errors (such as an API outage)
        if (curl_errno($ch) > 0) {
            //throw new Exception("Error connecting to API: " . curl_error($ch));
            $message = __("Error connecting to API !");
            return back()->withErrors($message)->withInput();
        }
        // If we reach this point in the code, we have a proper response!
        // Let's get the response code to check if the purchase code was found
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // HTTP 404 indicates that the purchase code doesn't exist
        if ($responseCode === 404) {
            //throw new Exception("The purchase code was invalid");
            $message = __("Purchase Code is invalid");
            return back()->withErrors($message)->withInput();
        }

        // Anything other than HTTP 200 indicates a request or API error
        // In this case, you should again ask the user to try again later
        if ($responseCode !== 200) {
            //throw new Exception("Failed to validate code due to an error: HTTP {$responseCode}");
            $message = __("Failed to validate code.");
            return back()->withErrors($message)->withInput();
        }

        // Parse the response into an object with warnings supressed
        $body = json_decode($response);

        // Check for errors while decoding the response (PHP 5.3+)
        if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
            //new Exception("Error parsing response");
            $message = __("Can't Verify Now.");
            return back()->withErrors($message)->withInput();
        }

        if ($body->item->id == '25300293') {

            if ($body->license == 'Extended License') {

                $env_keys_save = DotenvEditor::setKeys([
                    'ENABLE_SELLER_SUBS_SYSTEM' => 1,
                ]);

                $env_keys_save->save();

                Storage::disk('local')->put('/extended/' . 'extended.json', json_encode($code));

                $message = __("Seller subscription enabled successfully !");
                notify()->success($message);
                return back()->withInput();

            }

            $env_keys_save = DotenvEditor::setKeys([
                'ENABLE_SELLER_SUBS_SYSTEM' => 0,
            ]);

            $env_keys_save->save();

            $message = __("Seller subscription cannot be enabled with this Regular license.");
            notify()->error($message);
            return back()->withInput();

        } else {

            $env_keys_save = DotenvEditor::setKeys([
                'ENABLE_SELLER_SUBS_SYSTEM' => 0,
            ]);

            $env_keys_save->save();

            $message = __("Seller subscription cannot be enabled with this purchase code.");
            notify()->error($message);
            return back()->withInput();

        }

    }

    public function quicksettings(Request $request){

        abort_if(!auth()->user()->can('site-settings.genral-settings'), 403, 'User does not have the right permissions.');

        $env = DotenvEditor::setkeys([

            'ENABLE_PRELOADER'  => $request->ENABLE_PRELOADER ? 1 : 0,
            'APP_DEBUG'         => $request->APP_DEBUG ? "true" : "false",
            'COD_ENABLE'        => $request->COD_ENABLE ? 1 : 0,
            'HIDE_SIDEBAR'      => $request->HIDE_SIDEBAR ? 1 : 0,

        ]);

        $env->save();

        $settings = Genral::first();

        $settings->vendor_enable                  = $request->vendor_enable ? '1' : '0';
        $settings->right_click                    = $request->right_click ? '1' : '0';
        $settings->inspect                        = $request->inspect ? '1' : '0';
        $settings->login                          =  $request->login ? '1' : '0';
        $settings->email_verify_enable            =  $request->email_verify_enable ? '1' : '0';
        
        $settings->save();

        notify()->success('Settings updated !');

        return back();

    }

}
