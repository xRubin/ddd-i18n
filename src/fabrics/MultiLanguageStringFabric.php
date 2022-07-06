<?php declare(strict_types=1);

namespace ddd\i18n\fabrics;

use ddd\i18n\values\MultiLanguageString;

final class MultiLanguageStringFabric
{
    /** @var array|string[] */
    public static array $languages = ['en', 'ru'];
    /** @var callable */
    public static $translateCallback;

    /**
     * @param array $data
     * @param string|null $default
     * @return MultiLanguageString
     */
    public static function fromArray(array $data, ?string $default = null): MultiLanguageString
    {
        return new MultiLanguageString($data, $default);
    }

    /**
     * @param object $data
     * @param string|null $default
     * @return MultiLanguageString
     */
    public static function fromObject(object $data, ?string $default = null): MultiLanguageString
    {
        return new MultiLanguageString((array)$data, $default);
    }

    /**
     * @param string $key
     * @param array $params
     * @return MultiLanguageString
     */
    public static function fromKey(string $key, $params = null): MultiLanguageString
    {
        return self::fromArray(
            array_map(
                is_callable(self::$translateCallback) ? call_user_func_array(self::$translateCallback, $params) : $key,
                self::$languages
            )
        );
    }

    /**
     * @param string $json
     * @param string|null $default
     * @return MultiLanguageString
     */
    public static function fromJson(string $json, ?string $default = null): MultiLanguageString
    {
        return self::fromArray(json_decode($json, true), $default);
    }

    /**
     * @param string|null $default
     * @return MultiLanguageString
     */
    public static function fromDefault(?string $default = null): MultiLanguageString
    {
        return self::fromArray([], $default);
    }
}