<?php

// Config
define("ROOT", realpath(dirname(__FILE__) . "/../") . "/");

// App Config
define("APP_NAME", "PlanningPoker");
define("APP_ROOT", ROOT . "src/");
define("APP_PROTOCOL", stripos($_SERVER["SERVER_PROTOCOL"], "https") === true ? "https://" : "http://");
#define("APP_URL", APP_PROTOCOL . $_SERVER["HTTP_HOST"] . str_replace("public_html", "", dirname($_SERVER["SCRIPT_NAME"])) . "/");
define("APP_URL", APP_PROTOCOL . $_SERVER["HTTP_HOST"] . str_replace("public_html", "", dirname($_SERVER["SCRIPT_NAME"])) . "");
define("APP_CONFIG_FILE", APP_ROOT . "lang/en_config.php");
define("APP_ASSETS", APP_ROOT . "assets/");

// Public Config
define("PUBLIC_ROOT", ROOT . "public_html/");

// Controller Config
define("CONTROLLER_PATH", "\Controller\\");
define("DEFAULT_CONTROLLER", CONTROLLER_PATH . "IndexController");
define("DEFAULT_CONTROLLER_ACTION", "IndexAction");

// View Config
define("VIEW_PATH", "../src/views/");
define("DEFAULT_404_PATH", "_template/404.phtml");
define("DEFAULT_HEADER_PATH", "_template/header");
define("DEFAULT_FOOTER_PATH", "_template/footer");
define("HTMLENTITIES_FLAGS", ENT_QUOTES);
define("HTMLENTITIES_ENCODING", "UTF-8");
define("HTMLENTITIES_DOUBLE_ENCODE", false);