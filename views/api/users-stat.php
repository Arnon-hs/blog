<? 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

// get all users statistic

$app->get('/api/users/stat/', function (Request $request, Response $response, array $args) {
    try{
        $users = User::statistic();
        $json = json_encode($users);
        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    catch(Exception $e){
        echo 'Error ' . $e;
    }
    
});
$app->run();    