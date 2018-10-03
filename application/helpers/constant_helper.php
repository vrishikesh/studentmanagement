<?php

define('BASE_URL', base_url());
define('SITE_URL', site_url() . '/');
const ASSETS_URL = BASE_URL . 'assets/';
const FRAMEWORK_URL = ASSETS_URL . 'frameworks/';
const PLUGIN_URL = ASSETS_URL . 'plugins/';
const MODEL_PATH = '../../api/application/models/';

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
