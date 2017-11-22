<?php
/**
 * Created by PhpStorm.
 * User: Mike Bas
 * Date: 11/20/2017
 * Time: 3:26 PM
 */

namespace App;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FBConnection
{

    protected $database;
    protected const SERVICEPATH = '/../key/architecture-habbits-firebase-adminsdk-trgz6-d204782aaa.json';
    protected const APIKEY = 'AIzaSyDkktUYb8Ya__fWSKqslkaY6eArIJKIbVc';
    protected const DBURI = 'https://architecture-habbits.firebaseio.com/';

    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.self::SERVICEPATH);

        $firebase = (new Factory)
            ->withServiceAccountAndApiKey($serviceAccount, self::APIKEY)
            ->withDatabaseUri(self::DBURI)
            ->create();

        $this->database = $firebase->getDatabase();
    }

    public function getDatabase(){
        return $this->database;
    }

}