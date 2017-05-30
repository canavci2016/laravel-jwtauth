# laravel-jwtauth
laravel jwtauth kullanımı örnek


step-1 )
packages isimli klasörü laravel projenizin dizinine attıktan sonra.
composer  json dosyanızın  psr-4 yapısının içine aşağıdaki gibi
 "Can\\Jwt\\":"packages/can/jwt/src/"  şeklinde yapıştırın.
 ve terminalden  " composer dump-autoload " diyin
 


   "autoload": {
        "classmap": [
            "database"
        ],
        "psr-4": {
            "App\\": "app/",
            "Can\\Jwt\\":"packages/can/jwt/src/"
        }
    },
  
  
 step-2)  config/app.php giriş yapın
 
 providers içine  aşağıdaki satırı yapıştırın ;
 
 \Can\Jwt\JWTServiceProvider::class,
 
  alies içine  aşağıdaki satırı yapıştırın ;

 'jwtAuth'=>\Can\Jwt\JWTFacade::class,
 
 
 step-3) terminale "  php artisan vendor publish " yazdığınızda config içine  jwt/jwt.php yapısı  açılacaktır. Şifreleme
 algoritmamız ve güvenlik anahtarımız burda siz girip değiştirebilirsiniz.
 
 
 
  
 step-4 ) istediğiniz datalardan token oluşturmak için  aşağıdaki örnek
 
     $data=[                           // şifrelenmesini istediğiniz datalar
        'id'=>'23',
        'name'=>'can'
    ];
    
    
    $secondCount =7200;               //token geçerlilik süresi saniye cinsinden
    $serverName='http://canavci.com'      //server domain adınız domain bazlı şifreleme yapılıyor.
 
 echo  \jwtAuth::tokenGenerate($data,$secondCount,$serverName);
 
 
 step-5 ) token değerini  decode elde etmek için 
 
  echo  \jwtAuth::decode($token);
 
 
 
 


    
    
    
    
    
    
