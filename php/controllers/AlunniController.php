<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{

  function home(Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
  }

  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function getid(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = intval($args["id"]);
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE alunni.id = $id");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function postalunno(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');

    $body = $request->getBody()-> getContents();
    $parseBody = json_decode($body,true);

    $nome = $parseBody['nome'];
    $cognome = $parseBody['cognome']; 

    $result = $mysqli_connection->query("INSERT INTO alunni (nome, cognome) VALUES ('$nome','$cognome')");

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function putalunno(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = intval($args["id"]);
    $body = $request->getBody()-> getContents();
    $parseBody = json_decode($body,true);

    $nome = $parseBody['nome'];
    $cognome = $parseBody['cognome']; 

    $result = $mysqli_connection->query("UPDATE alunni SET nome = '$nome', cognome = '$cognome' WHERE alunni.id = $id");

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function deletealunno(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = intval($args["id"]);
    $result = $mysqli_connection->query("DELETE FROM alunni WHERE alunni.id = $id");

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  
}
