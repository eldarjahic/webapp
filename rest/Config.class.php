<?php
class Config
{
    public static function DB_HOST()
    {
        return 'db4free.net';
    }
    public static function DB_USERNAME()
    {
        return 'seproject';
    }
    public static function DB_PASSWORD()
    {
        return '00000000';
    }
    public static function DB_SCHEMA()
    {
        return 'pet_db';
    }
    public static function JWT_SECRET()
    {
        return Config::get_env("JWT_SECRET", "web-project");
    }
    public static function get_env($name, $default)
    {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }

}
?>