<? 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
// get single user

$app->get('/api/users/get/{id}', function (Request $request, Response $response, array $args) {

    try{
        $id = $request->getAttribute('id');
        $user = User::getUserById($id);
        $json = json_encode($user);
        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
    catch(Exception $e){
        echo 'Неправильно указан id';
    }

    return $response;
});

$app->run();    