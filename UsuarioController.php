<?php
    use \Firebase\JWT\JWT;
    use Slim\Psr7\Response;

    include_once('Usuario.php');
    include_once('UsuarioDAO.php');

    class UsuarioController{
        private $secretKey = "progr@macaoIntenetII";

        public function listar($request, $response, $args){
            $dao = new UsuarioDAO;
            $usuarios = $dao->selectAllUsers();

            return $response->withJSON($usarios);
        }

        public function insertUsers($request, $response, $args){
            $parseBody = $request->getParsedBody();
            $usuario = new Usuario(0, $parseBody['nome'], $parseBody['login'], $parseBody['senha']);
            $dao = new UsuarioDAO;
            $usuario = $dao->insertUser($usuario);

            return $response->withJSON($usuario, 201);
        }

        public function validaUser($request, $response, $args){
            $parseBody = $request->getParsedBody();
            $dao = new UsuarioDAO;
            
            $usuario = $dao->selectOneUser($parseBody['login']);
            
            if ($parseBody['login'] == $usuario->login and $parseBody['senha'] == $usuario->senha):
                $token = array(
                    'login' => $usuario->login,
                    'nome' => $usuario->nome
                );
                $jwt = JWT::encode($token, $this->secretKey);
                return $response->withJSON(["token" => $jwt], 201);
            else:
                return $response->withStatus(401);
            endif;   
        }

        public function validaToken($request, $handler){
            $response = new Response();
            $token = $request->getHeader('Authorization');
            
            if($token && $token[0]){
                try{
                    $decode = JWT::decode($token[0], $this->secretKey, array('HS256'));

                    if($decode){
                        $response = $handler->handle($request);
                        return($response);
                    }
                } catch(Execption $error){
                    return $response->withStatus(401);
                }
            }
            return $response->withStatus(401);
        }
    }
?>