<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Karigor\Helpers\EncodeHelper;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
	private $encodeHelper;

	public function __construct(EncodeHelper $encodeHelper)
    {
        $this->encodeHelper = $encodeHelper;
        
        $this->middleware('auth:api', ['except' => [
            'login', 
            'register' 
            ]
        ]);
    }

    public function login(Request $request)
    {
    	$credentials = $request->only(['email', 'password']);

    	$rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->respondValidationErrors($validator->messages());
        }

        if(!$user = $this->isRegistered($credentials['email'])){
            return $this->respondValidationError('This Account is not registered');
        }

        // if($user->email_verified_at == null) {
        // 	return $this->respondValidationError('You have not verified your email address');
        // }

        if(!$token = auth('api')->attempt($credentials)) {
			return $this->respondUnauthorized('Incorrect email/password');
		}

		return $this->createNewToken($token);
	}

    public function register(Request $request)
    {
        $credentials = $request->all();
        
        $rules = $this->registerValidation($credentials);
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->respondValidationErrors($validator->messages());
        }

        $user = User::create([
            'first_name' => $credentials['first_name'],
            'last_name' => $credentials['last_name'],
            'email' => $credentials['email'],
            'phone' => $credentials['phone'],
            'password' => bcrypt($credentials['password'])
        ]);
        // $verificationCode = str_random(30); //Generate verification code
        // $validationToken = VerificationToken::create([
        //         'reg_id' => $user->id,
        //         'token' => $verificationCode
        //     ]
        // );

        if(!$user) return $this->respondInternalError("Failed creating user");

        // return $this->sendMail(
        //     $user, 
        //     $verificationCode, 
        //     "Please verify your email address.", 
        //     "email.verify",
        //     "Thanks for signing up! Please check your mail to complete your registration."
        // );


        return $this->respond([
            'message' => 'User successfully registered',
            'user' => $this->transformUser($user)
        ]);
    }

    public function logout() {
        auth('api')->logout();

        return $this->respond(['message' => 'User successfully signed out']);
    }

    public function refresh() {
        return $this->createNewToken(auth('api')->refresh());
    }

    public function userProfile() {
        return $this->respond($this->transformUser());
    }

    public function registerValidation($credentials)
    {
        $rules = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|min:10|unique:users',
                'password' => [
                    'required',
                    'string',
                    'min:8',              // must be at least 8 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    // 'regex:/[@$!%*#?&]/', // must contain a special character
                ],
            ];
        return $rules;
    }


    private function isRegistered($email) {
    	return User::where('email', $email)->first();
    }

    private function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60, // seconds
            'user' => $this->transformUser()
        ]);
    }

	private function transformUser($user = null){
		$user = $user ? $user : auth('api')->user();

		return [
			'id'          => $this->encodeHelper->encodeData($user['id']),
            'first_name'  => $user['first_name'],
            'last_name'   => $user['last_name'],
            'email'       => $user['email'],
            'photo'       => $user['photo']
		];

	}
}