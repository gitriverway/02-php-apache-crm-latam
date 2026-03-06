<?php

class Modelo_Idioma
{
    private static $translations = null;
    private static $currentLang = 'pt-BR';
    private static $moduleFiles = [
        'common',
        'login',
        'menu',
        'clientes',
        'prospectos',
        'contratos',
        'siniestros',
        'reembolsos',
        'operatorios',
        'creditos',
        'usuarios',
        'empleados',
        'proveedores',
        'facturas',
        'emails'
    ];

    /**
     * Obtiene el idioma actual desde la sesión o usa el idioma por defecto
     */
    public static function getCurrentLanguage()
    {
        if (session_status() === PHP_SESSION_NONE) {
            if (!headers_sent()) {
                session_start();
            }
        }

        if (isset($_SESSION['S_IDIOMA'])) {
            return $_SESSION['S_IDIOMA'];
        }

        return 'pt-BR';
    }

    /**
     * Establece el idioma en la sesión
     */
    public static function setLanguage($lang)
    {
        if (session_status() === PHP_SESSION_NONE) {
            if (!headers_sent()) {
                session_start();
            }
        }

        $allowedLanguages = ['en', 'es', 'pt-BR'];
        if (in_array($lang, $allowedLanguages)) {
            $_SESSION['S_IDIOMA'] = $lang;
            self::$currentLang = $lang;
            self::$translations = null;
            return true;
        }

        return false;
    }

    /**
     * Carga las traducciones desde los archivos JSON modulares
     */
    private static function loadTranslations($lang = null)
    {
        if ($lang === null) {
            $lang = self::getCurrentLanguage();
        }

        if (self::$translations !== null && self::$currentLang === $lang) {
            return self::$translations;
        }

        $translations = [];

        $moduleLangDir = __DIR__ . '/../lang/' . $lang;

        if (is_dir($moduleLangDir)) {
            foreach (self::$moduleFiles as $module) {
                $moduleFile = $moduleLangDir . '/' . $module . '.json';
                if (file_exists($moduleFile)) {
                    $moduleContent = json_decode(file_get_contents($moduleFile), true);
                    if ($moduleContent) {
                        $translations[$module] = $moduleContent;
                    }
                }
            }
        }

        if (empty($translations) && $lang !== 'en') {
            $translations = self::loadTranslations('en');
        }

        self::$translations = $translations;
        self::$currentLang = $lang;

        return self::$translations;
    }

    /**
     * Obtiene una traducción por su clave
     * Ejemplo: t('common.login') o t('clientes.list_clients')
     * También soporta reemplazo de parámetros: t('email.subject', ['ticket' => 123])
     */
    public static function t($key, $params = null, $lang = null)
    {
        if (is_string($params)) {
            $lang = $params;
            $params = null;
        }

        $translations = self::loadTranslations($lang);

        $keys = explode('.', $key);
        $value = $translations;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $key;
            }
        }

        if ($params !== null && is_array($params)) {
            foreach ($params as $paramKey => $paramValue) {
                $value = str_replace('{' . $paramKey . '}', $paramValue, $value);
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

    /**
     * Obtiene la lista de módulos disponibles
     */
    public static function getAvailableModules()
    {
        return self::$moduleFiles;
    }
}
