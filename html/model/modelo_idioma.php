<?php

class Modelo_Idioma
{
    private static $translations = null;
    private static $currentLang = 'en';

    /**
     * Obtiene el idioma actual desde la sesión o usa el idioma por defecto
     */
    public static function getCurrentLanguage()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['S_IDIOMA'])) {
            return $_SESSION['S_IDIOMA'];
        }

        return 'en'; // Idioma por defecto: inglés
    }

    /**
     * Establece el idioma en la sesión
     */
    public static function setLanguage($lang)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $allowedLanguages = ['en', 'es', 'pt-BR'];
        if (in_array($lang, $allowedLanguages)) {
            $_SESSION['S_IDIOMA'] = $lang;
            self::$currentLang = $lang;
            return true;
        }

        return false;
    }

    /**
     * Carga las traducciones desde el archivo JSON
     */
    private static function loadTranslations($lang = null)
    {
        if ($lang === null) {
            $lang = self::getCurrentLanguage();
        }

        if (self::$translations !== null && self::$currentLang === $lang) {
            return self::$translations;
        }

        $langFile = __DIR__ . '/../lang/' . $lang . '.json';

        if (!file_exists($langFile)) {
            // Si el archivo no existe, usar inglés por defecto
            $langFile = __DIR__ . '/../lang/en.json';
        }

        $jsonContent = file_get_contents($langFile);
        self::$translations = json_decode($jsonContent, true);
        self::$currentLang = $lang;

        return self::$translations;
    }

    /**
     * Obtiene una traducción por su clave
     * Ejemplo: t('common.login') o t('messages.warning')
     */
    public static function t($key, $lang = null)
    {
        $translations = self::loadTranslations($lang);

        $keys = explode('.', $key);
        $value = $translations;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                // Si no se encuentra la traducción, devolver la clave
                return $key;
            }
        }

        return $value;
    }

    /**
     * Obtiene todas las traducciones del idioma actual
     */
    public static function getAllTranslations($lang = null)
    {
        return self::loadTranslations($lang);
    }
}

