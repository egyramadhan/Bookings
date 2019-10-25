<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\JsonResponse;
use App\Libraries\TransactionService;
use App\Bookings;
use Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AuthController extends Controller
{
    public function index($token)
	{
		$url = 'https://api.jouska.financial/api';
		$token_type = "Bearer ";
		$token_bearer = $token;
		$accept_type = 'application/json';

        //Read Data Customer (Data Customer)
		$client = new Client();
		$response_customer = $client->request('get', $url.'/usertoken/'.$token_bearer, [
			'headers' => [
				'Authorization' => $token_type . $token_bearer,
				'Accept' => $accept_type,
			],
		]);
		$data_customer = json_decode( $response_customer->getBody()->getContents());

		$response_personal_user = $client->request('get', $url.'/personal/user', [
			'headers' => [
				'Authorization' => $token_type . $token_bearer,
				'Accept' => $accept_type,
			],
		]);
		    $data_personal = json_decode( $response_personal_user->getBody()->getContents());
            
            // dd($data_personal->personal_phone);

            $check_data = Bookings::where('client_email', $data_customer->user->email)->first();
            if (empty($check_data)){  
            $user = new Bookings;
            $user->client_id = $data_customer->customer->unique_id;
            $user->client_name = $data_customer->user->name;
			$user->client_email = $data_customer->user->email;
			$user->client_phone = $data_personal->personal_phone;
            $user->save();
            }

            else {
                return JsonResponse::printJson([
                    'message' => 'user sudah ada'
                ]);
            }
            // dd($user);
		    return JsonResponse::printJson([
            'message' => 'success',
            'data' => $user,

            ]);
	}    
}
