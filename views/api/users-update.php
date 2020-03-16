<? 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

// get single user

//update single user

$app->put('/api/users/update/[{params:.*}]', function (Request $request, Response $response, array $args) {
    //todo
    try{
        $params = explode('/', $args['params']);
        $params[0]? $id = $params[0]: null;
        $params[1]? $name = $params[1] : null;
        $params[2]? $password = $params[2]: null;
        $user = User::edit($id,$name,$password);
        $json = json_encode($user);
        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
    catch(Exception $e){
        echo 'Ошибка ' . $e;
    }
    return $response;
});
$app->run();    