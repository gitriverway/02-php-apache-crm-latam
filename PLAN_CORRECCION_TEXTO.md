# Plan Sistemático para Corregir Texto Hardcodeado en Español

## Análisis del Proyecto

He analizado la estructura del proyecto y encontrado:

### Sistema de Idiomas Existente
- **Modelo**: `html/model/modelo_idioma.php` - Clase `Modelo_Idioma` con función `t()`
- **Idiomas**: `html/lang/` con archivos JSON para `es`, `en`, `pt-BR`
- **Función**: `$t('clave.seccion')` para traducciones

### Patrones Identificados (2094 instancias)

#### 1. Breadcrumbs - "Inicio" (33 archivos)
```php
// ANTES:
<li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

// DESPUÉS:
<li class="breadcrumb-item"><a href="inicio"><?php echo $t('common.home'); ?></a></li>
```

#### 2. Símbolos N°/Nº (77 ocurrencias)
```php
// ANTES:
N° Contrato, Nº Documento

// DESPUÉS:
Número Contrato, Número Documento
```

#### 3. Headers h1-h6
```php
// ANTES:
<h1>Lista de Clientes</h1>

// DESPUÉS:
<h1><?php echo $t('common.clients'); ?></h1>
```

#### 4. Labels de Formulario
```php
// ANTES:
<label>Nombre:</label>

// DESPUÉS:
<label><?php echo $t('form.name'); ?>:</label>
```

#### 5. Botones
```php
// ANTES:
<button type="submit">Guardar</button>

// DESPUÉS:
<button type="submit"><?php echo $t('common.save'); ?></button>
```

#### 6. Options de Select
```php
// ANTES:
<option value="">Seleccione...</option>

// DESPUÉS:
<option value=""><?php echo $t('messages.select_option'); ?></option>
```

## Script de Corrección Automática

He creado `corregir_texto_hardcodeado.php` que:

### Funcionalidades
1. **Escaneo sistemático** de todos los archivos PHP
2. **Detección de patrones** hardcodeados
3. **Reemplazo automático** con función `$t()`
4. **Backup automático** de archivos modificados
5. **Reporte detallado** de cambios realizados

### Patrones Implementados
- 25 patrones de corrección principales
- Breadcrumbs, headers, labels, botones, options
- Placeholders y mensajes de validación
- Símbolos N°/Nº a "Número"

### Ejecución
```bash
php corregir_texto_hardcodeado.php
```

## Claves de Traducción Utilizadas

### Basadas en es.json existente:
- `common.home` → "Inicio"
- `common.save` → "Guardar"
- `common.cancel` → "Cancelar"
- `common.edit` → "Editar"
- `common.delete` → "Eliminar"
- `form.name` → "Nombre"
- `form.email` → "Correo Electrónico"
- `form.phone` → "Teléfono"
- `messages.select_option` → "Seleccione..."

## Plan de Ejecución

### Fase 1: Preparación
1. ✅ Analizar estructura del proyecto
2. ✅ Identificar patrones comunes
3. ✅ Crear script de corrección
4. ✅ Verificar claves de traducción existentes

### Fase 2: Ejecución
1. Ejecutar script principal
2. Revisar reporte de cambios
3. Verificar archivos modificados
4. Probar funcionalidad

### Fase 3: Validación
1. Revisar que los archivos incluyan `modelo_idioma.php`
2. Verificar que las claves existan en todos los idiomas
3. Probar la aplicación en diferentes idiomas
4. Corregir cualquier problema manualmente

## Estadísticas Esperadas

- **Archivos a procesar**: ~100 archivos PHP
- **Reemplazos estimados**: 2000+ instancias
- **Patrones principales**: 25 tipos
- **Tiempo de ejecución**: ~2-5 minutos

## Recomendaciones

1. **Ejecutar en entorno de desarrollo** primero
2. **Revisar el reporte** antes de pasar a producción
3. **Verificar traducciones** en inglés y portugués
4. **Documentar nuevas claves** agregadas

El script está listo para ejecutarse y corregirá sistemáticamente todas las instancias de texto hardcodeado identificadas.