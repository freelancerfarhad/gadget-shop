<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;

class JWTToken{
    // Create Token
    public static function CreateToken($userEmail,$userID):string{

        $key = env('JWT_KEY');

        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60*60,
            'userEmail'=>$userEmail,
            'userID'=>$userID
        ];

        return $jwt = JWT::encode($payload, $key, 'HS256');
    }

    // Verify  Token
    public static function ReadToken($token):string|object{
        try{
            if($token==null){
                return "unauthorized";
            }
            else{

            $key = env('JWT_KEY');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return $decoded;
                            
            }

        }
        catch(Exception $e){
            return "unauthorized";
        }
    }

}