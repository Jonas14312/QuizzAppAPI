<?php

namespace App\Application\Actions\User;

use PDO;
use PDOException;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use App\Application\Actions\DBAction;
use Slim\Psr7\Response;

class Login extends DBAction
{

    protected function action(): Response
    {
        $body = $this->request->getBody()->getContents();
        $body = json_decode($body, true);
        $username = $body['Username'];
        $password = $body['Passwort'];

        if (!$username) {
            throw new HttpBadRequestException($this->request, "Der Username konnte nicht vom Body gelesen werden {$username}");
        }
        if (!$password) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument {$password}");
        }
        try {
            $this->connection->getConnection();
            $statement = $this->connection->getConnection()->prepare("SELECT * FROM [dbo].[DBD5_Spieler] WHERE Username = :username AND Passwort = :password");
            $statement->bindValue(':username', $username, PDO::PARAM_STR);
            $statement->bindValue(':password', $password, PDO::PARAM_STR);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $user = $statement->fetch();
            if ($user) {
                return $this->respondWithData($user);
            } else {
                //if there is no result from the query return a 404 status code
                throw new HttpNotFoundException($this->request, "User {$username} not found.");
            }
        } catch (PDOException $exception) {
            return $this->respondWithData([
                'Code'    => $exception->getCode(),
                'Message' => $exception->getMessage(),
                'File'    => $exception->getFile(),
                'Line'    => $exception->getLine()
            ], 500);
        }
    }
}
