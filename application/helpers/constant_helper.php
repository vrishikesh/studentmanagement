<?php

define('BASE_URL', base_url());

final class Url {

    private function __construct() {}
    
    const Site      = BASE_URL,
          Assets    = self::Site . 'assets/',
          Framework = self::Assets . 'frameworks/',
          Plugin    = self::Assets . 'plugins/';

}

final class Path {

    private function __construct() {}
    
    const Model   = '../../api/application/models/';

}

final class Deleted {

    private function __construct() {}

    const Yes = 1,
          No  = 0;

}

final class TableType {

    private function __construct() {}

    const System = 1,
          User   = 0;

}

final class UserType {

    private function __construct() {}

    const System       = 0,
          Organisation = 1,
          Brand        = 2,
          User         = 3;

}
