<?php

namespace App\Application\Actions;

use App\Application\Database\DBConnection;
use Psr\Log\LoggerInterface;

abstract class DBAction extends Action {

    protected DBConnection $connection;
    public function __construct(LoggerInterface $logger, DBConnection $DBConnection) {

        parent::__construct($logger);
        $this->connection = $DBConnection;
    }
}