<?php
define('APP_ROOT', dirname(__DIR__));

// CONFIGURAÇÕES DO BANCO ####################
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'bontur');
define('TIPO', 'mysql');

// DEFINE SERVIDOR DE E-MAIL ################
define('MAILUSER', 'contato@carlosasjr.com.br');
define('MAILPASS', 'puninho902405');
define('MAILPORT', 'postadeenvio');
define('MAILHOST', 'servidordeenvio');

// DEFINE IDENTIDADE DO SITE ################
define('SITENAME', 'Bontur Bondinhos Aéreos - Area de Vendas');
define(
    'SITEDESC',
    'Sistema de e-commerce da Bontur'
);

// DEFINE A BASE DO SITE ####################
define('HOME', 'https://www.carlosasjr.com.br/bontur');
define('THEME', 'bontur');

define('INCLUDE_PATH', HOME . '/src/' . THEME);
define('REQUIRE_PATH', 'src' . DIRECTORY_SEPARATOR . THEME);

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');
