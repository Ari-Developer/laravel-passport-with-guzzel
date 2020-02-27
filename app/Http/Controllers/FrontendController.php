<?php

namespace App\Http\Controllers;

use App\Helpers\Myhelper;
use Illuminate\Http\Request;
use Session;

class FrontendController extends Controller
{
    public $API_BASE_PATH = "http://localhost/PassportApplication/backEnd/api/v1/";

    public function userRegistration()
    {
        $DataBag = array();
        return view('user_registration', $DataBag);
    }

    public function userRegistrationSave(Request $request)
    {
        $apiPath = $this->API_BASE_PATH . 'register';
        $data = array();
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');
        $data['c_password'] = $request->input('c_password');
        $apiResponse = Myhelper::httpRequest($request, 'POST', $apiPath, json_encode($data));
        $apiResponseBody = json_decode($apiResponse->getBody());
        if ($apiResponse->getStatusCode() === 200) {
            return back()->with('success', 'Registration Complete.');
        } elseif ($apiResponse->getStatusCode() === 401) {
            $getErrors = '';
            if (!empty($apiResponseBody->error)) {
                foreach ($apiResponseBody->error as $k => $v) {
                    foreach ($v as $err) {
                        $getErrors .= $err . '<br/>';
                    }
                }
            }
            return back()->with('error', $getErrors);
        } else {
            return back()->with('error', 'Server Error');
        }
    }

    public function userLogin()
    {
        $DataBag = array();
        return view('user_login', $DataBag);
    }

    public function userLoginProcess(Request $request)
    {
        $apiPath = $this->API_BASE_PATH . 'login';
        $data = array();
        $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');
        $apiResponse = Myhelper::httpRequest($request, 'POST', $apiPath, json_encode($data));
        $apiResponseBody = json_decode($apiResponse->getBody());
        if ($apiResponse->getStatusCode() === 200) {
            Session::put('token', $apiResponseBody->success->token);
            return redirect()->route('user.account')->with('success', 'Login Successfull.');
        } elseif ($apiResponse->getStatusCode() === 401) {
            $getErrors = '';
            if (isset($apiResponseBody->error) && !empty($apiResponseBody->error)) {
                foreach ($apiResponseBody->error as $k => $v) {
                    foreach ($v as $err) {
                        $getErrors .= $err . '<br/>';
                    }
                }
            }
            if (isset($apiResponseBody->wrong)) {
                $getErrors = $apiResponseBody->wrong;
            }
            return back()->with('error', $getErrors);
        } else {
            return back()->with('error', 'Server Error');
        }
    }

    public function userAccount(Request $request)
    {
        $apiPath = $this->API_BASE_PATH . 'details';
        $data = array();
        $DataBag = array();
        $apiResponse = Myhelper::httpRequest($request, 'POST', $apiPath, json_encode($data), 1);
        $apiResponseBody = json_decode($apiResponse->getBody());
        if ($apiResponse->getStatusCode() === 200) {
            $DataBag['userInfo'] = $apiResponseBody->user;
            return view('user_account', $DataBag);
        } else {
            return back()->with('error', 'Unauthorized Access');
        }
    }

    public function userLogout()
    {
        Session::put('token', '');
        Session::forget('token');
        return redirect()->route('user.registration')->with('success', 'Logout Successfull.');
    }

    public function userLoginGrantType(Request $request)
    {
        $data = array();
        $data['grant_type'] = 'password';
        $data['client_id'] = env('Password_Client_ID');
        $data['client_secret'] = env('Password_Client_Secret');
        $data['username'] = $request->get('email');
        $data['password'] = $request->get('password');
        $data['scope'] = '*';
        $loginTokenResponse = Myhelper::getLoginToken($request, $data);
        $loginTokenResponseBody = json_decode((string) $loginTokenResponse->getBody());
        //dd($loginTokenResponseBody);
        if ($loginTokenResponse->getStatusCode() === 200) {
            Session::put('token', $loginTokenResponseBody->access_token);
            return redirect()->route('user.account')->with('success', 'Login Successfull with grant type.');
        } elseif ($loginTokenResponse->getStatusCode() === 400) {
            return back()->with('error', $loginTokenResponseBody->message);
        } elseif ($loginTokenResponse->getStatusCode() === 401) {
            return back()->with('error', $loginTokenResponseBody->message);
        } else {
            return back()->with('error', 'SERVER ERROR');
        }
    }
}
