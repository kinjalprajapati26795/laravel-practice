<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserTechnology;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected $redirectTo='/home';
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(SignUpRequest $request)
    {

        try{
                   

            $user = new User([
                'first_name' => $request->first_name,
                'last_name'=>$request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);        
            
            $user->save();  
            $id= $user->id;
            $technologiesArr=array();
            foreach ($request->technologies as $key => $value) {
                if(!is_null($value))
                {
                    $technologiesArr[$key]['user_id']=$id;
                    $technologiesArr[$key]['technology']=$value;
                    $technologiesArr[$key]['created_at']=date('Y-m-d H:i:s');
                    $technologiesArr[$key]['updated_at']=date('Y-m-d H:i:s');
                }
             }   
             if(count($technologiesArr)>0)
             {
                UserTechnology::insert($technologiesArr);
             }  
            return response()->json([
                'message' => 'Successfully created user!',
                'status'=>1,
                'code'=>'201'
            ], 201);
        }
        catch (Exception $ex)
        {
            return response()->json([
                'message' => $ex->message,
                'status'=>0,
                'code'=>'404'
            ], 404);
        }
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);        $credentials = request(['email', 'password']); 

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);        $user = $request->user();        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;        
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);        
            $token->save(); 
            if($request->request_from='web')
            {
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString(),
                    'status'=>1,
                    'code'=>'201',
                    'redirectTo'=>route('home')
                ]);
               
            }   
            else{
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString(),
                    'status'=>1,
                    'code'=>'201'
                ]);
            }    
            
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
