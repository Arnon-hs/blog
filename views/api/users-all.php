<? 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

// get all users

$app->get('/api/users/all/', function (Request $request, Response $response, array $args) {
    try{
        $users = User::findAllUser();
        $usersArray = [];
        foreach($users as $index => $user){
            $usersArray[$index] = $user;
        }
        $json = json_encode($usersArray);
        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
    catch(Exception $e){
        echo 'Error ' . $e;
    }
    
});
$app->run();    