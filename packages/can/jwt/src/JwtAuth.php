<?php
namespace Can\Jwt;


use Firebase\JWT\JWT;

use Can\Jwt\JwtUser;

class  JwtAuth extends JwtUser
{

    private $secretKey = null;
    private $algorithm = null;

    /**
     * JwtAuth constructor.
     */
    public function __construct()
    {
        $this->loadFields();
        $this->loadVendor();
    }

    private function loadVendor()
    {
        require __DIR__ . '/../vendor/autoload.php';

    }

    public function loadFields()
    {
        $this->secretKey = config('jwtphp.secret');
        $this->algorithm = config('jwtphp.algorithm');
    }



    public function tokenGenerate(array  $dataFields, $secondCount = 7200, $serverName = 'http://localhost/php-json/')
    {

        $tokenId = base64_encode(mcrypt_create_iv(32));
        $issuedAt = time();
        $notBefore = $issuedAt + 10;  //Adding 10 seconds
        $expire = $notBefore + $secondCount; // Adding 60 minutes


        /*
         * Create the token as an array
         */
        $data = [
            'iat' => $issuedAt,         // Issued at: time when the token was generated
            'jti' => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss' => $serverName,       // Issuer
            'nbf' => $notBefore,        // Not before
            'exp' => $expire,           // Expire
            'data' => $dataFields
        ];


        return $this->encode($data);

    }


    private function encode($data)
    {
        try {

            /// Here we will transform this array into JWT:
            $jwt = JWT::encode(
                $data, //Data to be encoded in the JWT
                $this->secretKey, // The signing key
                $this->algorithm
            );

            return "{'status' : 'success' ,'token':" . $jwt . "}";
        } catch (\Exception $e) {
            return "{'status' : 'fail' ,'msg':'".$e->getMessage()."'}";
        }

    }


    public function decode($token)
    {

        try {

            $DecodedDataArray = JWT::decode(
                $token,
                $this->secretKey,
                [$this->algorithm]
            );

            return "{'status' : 'success' ,'data':" . json_encode($DecodedDataArray->data) . " }";

        } catch (\Exception $e) {
            return "{'status' : 'fail' ,'msg':'".$e->getMessage()."'}";
        }


    }


}