<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env('FIREBASE_DB_URL'));
        
        $this->database = $factory->createDatabase();
        
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }
}
