<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'juveros-blog' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'MYiLA' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '75511557' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'jV4Klm32vteECkjzl#e[whd?>A%=@]YHPsIkLAex:G_ HpJuZh1nW@7zA|0_7ZU@' );
define( 'SECURE_AUTH_KEY',  'S6^502B  U^8v`m!J*lY+O8Np^=Jam526[p@x5h:_)#h}46fZs9B%gxZ^ -/H5v%' );
define( 'LOGGED_IN_KEY',    'LeNAK)r>$?cTYk-ulr+FDa3%^xp,uN}uk0K`z*g,tP#q<$CpKT2?X^)Y-:i-)34 ' );
define( 'NONCE_KEY',        '3>`ik,c*pl0JsViY%d X5#x`3}0%s+pb0>`j+95x>M&#r<%HNK8;J!&hsYh|vWn}' );
define( 'AUTH_SALT',        'RZ`zN--33~T`Z)TcY_kzU8W.}DbL0p}#5eB;FF=AXLsP@;a#{xvqrO(+l2^W;dcU' );
define( 'SECURE_AUTH_SALT', 'dXTcX!cnR=Na}wEnSmI~zzDVG%dhSx5vBVn5X %$1o2#M98}~lKDpS&ftJ|kK2R&' );
define( 'LOGGED_IN_SALT',   'q e#<hlvC{s|0{jJ]2l|uZ]/o<.)A7vjRh59{k-6K;:F>x(C.])iaD$1<i0QX2z/' );
define( 'NONCE_SALT',       '2R)tkc+Y.jl:,7Wr)nPPymwK0Sm7t4|4mF$|u8NsX=!M/y^DXX_~sW8W))ZYTQK8' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
