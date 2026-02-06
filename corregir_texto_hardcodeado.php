<?php
/**
 * Script sistemático para corregir texto hardcodeado en español en archivos PHP
 * 
 * Este script identifica y reemplaza patrones comunes de texto en español
 * con llamadas a la función de traducción $t() del sistema de idiomas.
 */

// Configuración
$directorioBase = __DIR__ . '/html';
$archivosPhp = [];
$patronesCorreccion = [];
$estadisticas = [
    'archivos_procesados' => 0,
    'reemplazos_realizados' => 0,
    'patrones_encontrados' => []
];

// El modelo de idioma se inicializará en cada archivo cuando sea necesario

/**
 * Define los patrones de corrección y sus reemplazos correspondientes
 */
function inicializarPatronesCorreccion() {
    global $patronesCorreccion;
    
    $patronesCorreccion = [
        // Patrones de breadcrumbs y navegación
        'Inicio' => [
            'busqueda' => '>Inicio<',
            'reemplazo' => '><?php echo $t(\'common.home\'); ?><',
            'descripcion' => 'Breadcrumb Inicio'
        ],
        
        // Patrones de N° y Nº - mantener consistencia con "Número"
        [
            'busqueda' => 'N°',
            'reemplazo' => 'Número',
            'descripcion' => 'Símbolo N° a Número'
        ],
        [
            'busqueda' => 'Nº',
            'reemplazo' => 'Número',
            'descripcion' => 'Símbolo Nº a Número'
        ],
        
        // Headers h1-h6 comunes
        [
            'busqueda' => '<h1>Lista de Clientes</h1>',
            'reemplazo' => '<h1><?php echo $t(\'common.clients\'); ?></h1>',
            'descripcion' => 'Header Lista de Clientes'
        ],
        [
            'busqueda' => '<h1>Lista de Usuarios</h1>',
            'reemplazo' => '<h1><?php echo $t(\'common.users\'); ?></h1>',
            'descripcion' => 'Header Lista de Usuarios'
        ],
        [
            'busqueda' => '<h1>Lista de Proveedores</h1>',
            'reemplazo' => '<h1><?php echo $t(\'common.providers\'); ?></h1>',
            'descripcion' => 'Header Lista de Proveedores'
        ],
        
        // Headers específicos encontrados en view/module
        [
            'busqueda' => '<h1>Editar Prospecto Pymes',
            'reemplazo' => '<h1><?php echo $t(\'form.edit_prospect_pymes\'); ?>',
            'descripcion' => 'Header Editar Prospecto Pymes'
        ],
        [
            'busqueda' => '<li class="breadcrumb-item active">Editar Prospecto Pymes</li>',
            'reemplazo' => '<li class="breadcrumb-item active"><?php echo $t(\'form.edit_prospect_pymes\'); ?></li>',
            'descripcion' => 'Breadcrumb Editar Prospecto Pymes'
        ],
        [
            'busqueda' => '<h3 class="card-title">Datos Bayer Persona</h3>',
            'reemplazo' => '<h3 class="card-title"><?php echo $t(\'form.bayer_person_data\'); ?></h3>',
            'descripcion' => 'Header Datos Bayer Persona'
        ],
        
        // Labels específicos encontrados
        [
            'busqueda' => 'style="text-align: right;">VENDEDOR</label>',
            'reemplazo' => 'style="text-align: right;"><?php echo $t(\'form.seller\'); ?></label>',
            'descripcion' => 'Label VENDEDOR'
        ],
        [
            'busqueda' => '<label for="cbm_origen" class=" control-label" style="text-align: right;">ORIGEN',
            'reemplazo' => '<label for="cbm_origen" class=" control-label" style="text-align: right;"><?php echo $t(\'form.origin\'); ?>',
            'descripcion' => 'Label ORIGEN'
        ],
        [
            'busqueda' => '<label for="txt_origen_web" class="control-label" style="text-align: right;">ORIGEN WEB',
            'reemplazo' => '<label for="txt_origen_web" class="control-label" style="text-align: right;"><?php echo $t(\'form.web_origin\'); ?>',
            'descripcion' => 'Label ORIGEN WEB'
        ],
        [
            'busqueda' => '<label for="cbm_categoria" class=" control-label" style="text-align: right;">RAMOS',
            'reemplazo' => '<label for="cbm_categoria" class=" control-label" style="text-align: right;"><?php echo $t(\'form.categories\'); ?>',
            'descripcion' => 'Label RAMOS'
        ],
        
// Options específicos encontrados
        [
            'busqueda' => '<option value="OTROS">OTROS</option>',
            'reemplazo' => '<option value="OTROS"><?php echo $t(\'options.others\'); ?></option>',
            'descripcion' => 'Option OTROS'
        ],
        
        // Patrones adicionales comunes
        [
            'busqueda' => 'style="text-align: right;">ORIGEN',
            'reemplazo' => 'style="text-align: right;"><?php echo $t(\'form.origin\'); ?>',
            'descripcion' => 'Label ORIGEN'
        ],
        [
            'busqueda' => 'style="text-align: right;">ORIGEN WEB',
            'reemplazo' => 'style="text-align: right;"><?php echo $t(\'form.web_origin\'); ?>',
            'descripcion' => 'Label ORIGEN WEB'
        ],
        [
            'busqueda' => 'style="text-align: right;">RAMOS',
            'reemplazo' => 'style="text-align: right;"><?php echo $t(\'form.categories\'); ?>',
            'descripcion' => 'Label RAMOS'
        ],
        
        // Comentarios y títulos de modales
        [
            'busqueda' => '<!-- ENTRADA VENDEDOR -->',
            'reemplazo' => '<!-- ENTRADA VENDEDOR -->',
            'descripcion' => 'Comentario ENTRADA VENDEDOR (sin cambios)'
        ],
        [
            'busqueda' => 'MODAL ASIGNAR VENDEDOR',
            'reemplazo' => '<?php echo $t(\'modal.assign_seller\'); ?>',
            'descripcion' => 'Modal Asignar Vendedor'
        ],
        
        // Headers de tarjetas
        [
            'busqueda' => '<h3 class="card-title">Datos Bayer Persona</h3>',
            'reemplazo' => '<h3 class="card-title"><?php echo $t(\'form.bayer_person_data\'); ?></h3>',
            'descripcion' => 'Header Datos Bayer Persona'
        ],
        [
            'busqueda' => '<option value="AMIGO">AMIGO</option>',
            'reemplazo' => '<option value="AMIGO"><?php echo $t(\'options.friend\'); ?></option>',
            'descripcion' => 'Option AMIGO'
        ],
        [
            'busqueda' => '<option value="CHAT">CHAT</option>',
            'reemplazo' => '<option value="CHAT"><?php echo $t(\'options.chat\'); ?></option>',
            'descripcion' => 'Option CHAT'
        ],
        [
            'busqueda' => '<option value="OTROS">OTROS</option>',
            'reemplazo' => '<option value="OTROS"><?php echo $t(\'options.others\'); ?></option>',
            'descripcion' => 'Option OTROS'
        ],
        
        // Labels de formulario comunes
        [
            'busqueda' => '<label>Nombre:</label>',
            'reemplazo' => '<label><?php echo $t(\'form.name\'); ?>:</label>',
            'descripcion' => 'Label Nombre'
        ],
        [
            'busqueda' => '<label>Correo Electrónico:</label>',
            'reemplazo' => '<label><?php echo $t(\'form.email\'); ?>:</label>',
            'descripcion' => 'Label Correo Electrónico'
        ],
        [
            'busqueda' => '<label>Teléfono:</label>',
            'reemplazo' => '<label><?php echo $t(\'form.phone\'); ?>:</label>',
            'descripcion' => 'Label Teléfono'
        ],
        [
            'busqueda' => '<label>Dirección:</label>',
            'reemplazo' => '<label><?php echo $t(\'form.address\'); ?>:</label>',
            'descripcion' => 'Label Dirección'
        ],
        
        // Botones comunes
        [
            'busqueda' => '<button type="submit" class="btn btn-primary">Guardar</button>',
            'reemplazo' => '<button type="submit" class="btn btn-primary"><?php echo $t(\'common.save\'); ?></button>',
            'descripcion' => 'Botón Guardar'
        ],
        [
            'busqueda' => '<button type="button" class="btn btn-secondary">Cancelar</button>',
            'reemplazo' => '<button type="button" class="btn btn-secondary"><?php echo $t(\'common.cancel\'); ?></button>',
            'descripcion' => 'Botón Cancelar'
        ],
        [
            'busqueda' => '<button type="button" class="btn btn-info">Editar</button>',
            'reemplazo' => '<button type="button" class="btn btn-info"><?php echo $t(\'common.edit\'); ?></button>',
            'descripcion' => 'Botón Editar'
        ],
        [
            'busqueda' => '<button type="button" class="btn btn-danger">Eliminar</button>',
            'reemplazo' => '<button type="button" class="btn btn-danger"><?php echo $t(\'common.delete\'); ?></button>',
            'descripcion' => 'Botón Eliminar'
        ],
        
        // Options de select comunes
        [
            'busqueda' => '<option value="">Seleccione...</option>',
            'reemplazo' => '<option value=""><?php echo $t(\'messages.select_option\'); ?></option>',
            'descripcion' => 'Option Seleccione'
        ],
        [
            'busqueda' => '<option value="M">Masculino</option>',
            'reemplazo' => '<option value="M"><?php echo $t(\'form.male\'); ?></option>',
            'descripcion' => 'Option Masculino'
        ],
        [
            'busqueda' => '<option value="F">Femenino</option>',
            'reemplazo' => '<option value="F"><?php echo $t(\'form.female\'); ?></option>',
            'descripcion' => 'Option Femenino'
        ],
        
        // Títulos de tablas comunes
        [
            'busqueda' => '<th>Nombre</th>',
            'reemplazo' => '<th><?php echo $t(\'list_tables.name\'); ?></th>',
            'descripcion' => 'TH Nombre'
        ],
        [
            'busqueda' => '<th>Acciones</th>',
            'reemplazo' => '<th><?php echo $t(\'list_tables.actions\'); ?></th>',
            'descripcion' => 'TH Acciones'
        ],
        [
            'busqueda' => '<th>Estado</th>',
            'reemplazo' => '<th><?php echo $t(\'list_tables.status\'); ?></th>',
            'descripcion' => 'TH Estado'
        ],
        [
            'busqueda' => '<th>Teléfono</th>',
            'reemplazo' => '<th><?php echo $t(\'list_tables.phone\'); ?></th>',
            'descripcion' => 'TH Teléfono'
        ],
        [
            'busqueda' => '<th>Correo Electrónico</th>',
            'reemplazo' => '<th><?php echo $t(\'list_tables.email\'); ?></th>',
            'descripcion' => 'TH Correo Electrónico'
        ],
        
        // Placeholders comunes
        [
            'busqueda' => 'placeholder="Ingrese su nombre"',
            'reemplazo' => 'placeholder="<?php echo $t(\'form.enter_name\'); ?>"',
            'descripcion' => 'Placeholder Nombre'
        ],
        [
            'busqueda' => 'placeholder="Ingrese su correo electrónico"',
            'reemplazo' => 'placeholder="<?php echo $t(\'form.enter_email\'); ?>"',
            'descripcion' => 'Placeholder Correo Electrónico'
        ],
        [
            'busqueda' => 'placeholder="Ingrese su teléfono"',
            'reemplazo' => 'placeholder="<?php echo $t(\'form.enter_phone\'); ?>"',
            'descripcion' => 'Placeholder Teléfono'
        ],
        
        // Mensajes de validación comunes
        [
            'busqueda' => 'Por favor, complete todos los campos obligatorios',
            'reemplazo' => '<?php echo $t(\'messages.fill_empty_fields\'); ?>',
            'descripcion' => 'Mensaje validación campos obligatorios'
        ],
        [
            'busqueda' => 'Datos actualizados correctamente',
            'reemplazo' => '<?php echo $t(\'messages.data_updated_successfully\'); ?>',
            'descripcion' => 'Mensaje actualización exitosa'
        ],
        [
            'busqueda' => 'Error al procesar la solicitud',
            'reemplazo' => '<?php echo $t(\'messages.error\'); ?>',
            'descripcion' => 'Mensaje error genérico'
        ]
    ];
}

/**
 * Encuentra todos los archivos PHP en el directorio base
 */
function encontrarArchivosPhp($directorio) {
    global $archivosPhp;
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directorio)
    );
    
    foreach ($iterator as $archivo) {
        if ($archivo->isFile() && $archivo->getExtension() === 'php') {
            $archivosPhp[] = $archivo->getPathname();
        }
    }
}

/**
 * Agrega el sistema de idiomas a un archivo si no lo tiene
 */
function agregarSistemaIdiomas($rutaArchivo, &$contenido) {
    // Verificar si el archivo ya incluye el sistema de idiomas
    if (strpos($contenido, 'require_once') !== false && 
        strpos($contenido, 'modelo_idioma.php') !== false) {
        return false; // Ya tiene el sistema de idiomas
    }
    
    // Encontrar la primera línea después de <?php
    $lineas = explode("\n", $contenido);
    $nuevoContenido = [];
    $agregado = false;
    
    foreach ($lineas as $linea) {
        $nuevoContenido[] = $linea;
        
        // Si encontramos la etiqueta de apertura PHP y no hemos agregado aún
        if (strpos($linea, '<?php') === 0 && !$agregado) {
            // Agregar el sistema de idiomas
            $nuevoContenido[] = "require_once __DIR__ . '/../../model/modelo_idioma.php';";
            $nuevoContenido[] = "\$t = function (\$key) {";
            $nuevoContenido[] = "    return Modelo_Idioma::t(\$key);";
            $nuevoContenido[] = "};";
            $nuevoContenido[] = "";
            $agregado = true;
        }
    }
    
    $contenido = implode("\n", $nuevoContenido);
    return $agregado;
}

/**
 * Analiza un archivo en busca de patrones de texto hardcodeado
 */
function analizarArchivo($rutaArchivo) {
    global $patronesCorreccion, $estadisticas;
    
    $contenido = file_get_contents($rutaArchivo);
    $patronesEncontrados = [];
    $reemplazosRealizados = 0;
    $sistemaIdiomasAgregado = false;
    
    // Agregar sistema de idiomas si es necesario
    if (agregarSistemaIdiomas($rutaArchivo, $contenido)) {
        $sistemaIdiomasAgregado = true;
        echo "Sistema de idiomas agregado a: $rutaArchivo\n";
    }
    
    // Buscar cada patrón de corrección
    foreach ($patronesCorreccion as $patron) {
        $busqueda = $patron['busqueda'];
        $reemplazo = $patron['reemplazo'];
        $descripcion = $patron['descripcion'];
        
        // Contar ocurrencias del patrón
        $ocurrencias = substr_count($contenido, $busqueda);
        
        if ($ocurrencias > 0) {
            $patronesEncontrados[] = [
                'patron' => $descripcion,
                'ocurrencias' => $ocurrencias,
                'busqueda' => $busqueda,
                'reemplazo' => $reemplazo
            ];
            
            // Realizar el reemplazo
            $contenido = str_replace($busqueda, $reemplazo, $contenido);
            $reemplazosRealizados += $ocurrencias;
            
            // Actualizar estadísticas
            if (!isset($estadisticas['patrones_encontrados'][$descripcion])) {
                $estadisticas['patrones_encontrados'][$descripcion] = 0;
            }
            $estadisticas['patrones_encontrados'][$descripcion] += $ocurrencias;
        }
    }
    
    // Si se encontraron patrones o se agregó el sistema de idiomas, guardar el archivo modificado
    if (!empty($patronesEncontrados) || $sistemaIdiomasAgregado) {
        // Crear backup
        $backupFile = $rutaArchivo . '.backup.' . date('Y-m-d-H-i-s');
        copy($rutaArchivo, $backupFile);
        
        // Guardar archivo modificado
        file_put_contents($rutaArchivo, $contenido);
        
        echo "Archivo procesado: $rutaArchivo\n";
        echo "  - Backup creado: $backupFile\n";
        
        if ($sistemaIdiomasAgregado) {
            echo "  - Sistema de idiomas agregado\n";
        }
        
        if ($reemplazosRealizados > 0) {
            echo "  - Reemplazos realizados: $reemplazosRealizados\n";
            
            foreach ($patronesEncontrados as $patron) {
                echo "    * {$patron['patron']}: {$patron['ocurrencias']} ocurrencias\n";
            }
        }
        echo "\n";
        
        $estadisticas['archivos_procesados']++;
        $estadisticas['reemplazos_realizados'] += $reemplazosRealizados;
        
        return true;
    }
    
    return false;
}

/**
 * Genera un reporte detallado de los cambios realizados
 */
function generarReporte() {
    global $estadisticas;
    
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "REPORTE DE CORRECCIÓN DE TEXTO HARDCODEADO\n";
    echo str_repeat("=", 80) . "\n";
    
    echo "Archivos procesados: {$estadisticas['archivos_procesados']}\n";
    echo "Reemplazos totales realizados: {$estadisticas['reemplazos_realizados']}\n\n";
    
    echo "Patrones encontrados y corregidos:\n";
    echo str_repeat("-", 40) . "\n";
    
    foreach ($estadisticas['patrones_encontrados'] as $patron => $cantidad) {
        echo "  - $patron: $cantidad ocurrencias\n";
    }
    
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "PROCESO COMPLETADO\n";
    echo str_repeat("=", 80) . "\n";
}

/**
 * Función principal que ejecuta todo el proceso
 */
function main() {
    global $directorioBase;
    
    echo "INICIANDO PROCESO DE CORRECCIÓN DE TEXTO HARDCODEADO\n";
    echo "Directorio base: $directorioBase\n\n";
    
    // Inicializar patrones de corrección
    inicializarPatronesCorreccion();
    echo "Patrones de corrección inicializados: " . count($GLOBALS['patronesCorreccion']) . "\n\n";
    
    // Encontrar todos los archivos PHP
    echo "Buscando archivos PHP...\n";
    encontrarArchivosPhp($directorioBase);
    echo "Archivos PHP encontrados: " . count($GLOBALS['archivosPhp']) . "\n\n";
    
    // Procesar cada archivo
    echo "Procesando archivos...\n";
    echo str_repeat("-", 50) . "\n";
    
    $archivosModificados = 0;
    foreach ($GLOBALS['archivosPhp'] as $archivo) {
        if (analizarArchivo($archivo)) {
            $archivosModificados++;
        }
    }
    
    echo "\nProceso finalizado. $archivosModificados archivos fueron modificados.\n";
    
    // Generar reporte
    generarReporte();
}

// Ejecutar el script
if (php_sapi_name() === 'cli') {
    main();
} else {
    echo "Este script debe ejecutarse desde la línea de comandos.\n";
    echo "Ejecute: php corregir_texto_hardcodeado.php\n";
}
?>