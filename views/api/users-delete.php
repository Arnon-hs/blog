<? 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

//delete single user

$app->delete('/api/users/delete/{id}', function (Request $request, Response $response, array $args) {
    try{
        $id = $request->getAttribute('id');
        User::delete($id)?
            $response->getBody()->write('Успешное удаление!'): 
                exit('Ошибка при удалении');
        return $response->withStatus(201);
    }
    catch(Exception $e){
        echo 'Ошибка ' . $e;
    }
    return $response;
});
$app->run();    