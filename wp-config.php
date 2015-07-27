<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'foco');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'lV|rhV]s 5I2$O9VJ6PuE|<ZL&^wA~1j<-l{vc>%CwvYu0~=vDt;>IQ* SsEwX(e');
define('SECURE_AUTH_KEY',  '@ET,mKa*$bKf8b.f:=8+vMXO9I#uqaKKcLJ:Pnxi_ghfb,%Zlc4Ku6S>Y|.8)V~5');
define('LOGGED_IN_KEY',    'QE=}20(]YdN2&nnea<1j>ZF*<(9UOiub[(7Cl,EI3bu.(W.8D3p)v5U}ROo+l/X~');
define('NONCE_KEY',        '7cbumTgucb`BP/tVS,P8jr[,9i[#OM~^ae2~k[ .EdgOQDl%l:Fwb[HI&_+TSwYR');
define('AUTH_SALT',        '[ID~LdvvaUM2EjK.3b72vo^KycG2,(=SMav(v2I*+xiFT5bcMH.;aExE{2s}5nBl');
define('SECURE_AUTH_SALT', '=?iuv7/Dn/rrE|RNQ-!_hL.ldG(Re!BeatfAFs3!/#8dM[-;PO(>n>=X&OaXe7Ol');
define('LOGGED_IN_SALT',   '3*lf:~N5RG-~DSrBO}$,zuH?&o:9=w0^5Ah /IDHtj0@Bchs-3`<*@iWqZ<yJ({~');
define('NONCE_SALT',       'ceFp=NH8T]BP8}TF=3B(l8)F.Z|*<[x*HjP.$D,)nrz&@u$E%.)>fa^<&}l`xLwY');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
