<? 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
//post single user

$app->post('/api/users/post/[{params:.*}]', function (Request $request, Response $response, array $args) {//getParams???? 
    
    try{
        $params = explode('/', $args['params']);
        $params[0]? $email = $params[0]: null;
        $params[1]? $name = $params[1] : null;
        $params[2]? $password = $params[2]: null;
        
        if(User::checkEmailExists($email) || !User::checkEmail($email))
            exit('Ошибка неверный email');
        if(!User::checkPassword($password))
            exit('Ошибка пароль слишком короткий');
            
        $passwordHash=crypt($password,'$2a$07$usesomesillystringforsalt$');
        $user = User::register($name,$email,$passwordHash);
        $json = json_encode($user);
        $response->getBody()->write('Успешно!');
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
    catch(Exception $e){
        echo 'Ошибка ' . $e;
    }
    return $response;
});
$app->run();    