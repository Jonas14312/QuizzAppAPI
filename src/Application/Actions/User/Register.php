<?php 

namespace App\Application\Actions\User;

use App\Application\Actions\DBAction;
use Slim\Psr7\Response;

class Register extends DBAction {

    protected function action(): Response {
        return $this->respondWithData([
            "Message" => "TEST",
        ]);
    }

}