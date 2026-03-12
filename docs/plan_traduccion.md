# Plan de Traducción del Proyecto CRM RIVERWAY Seguros

## Resumen Ejecutivo

El proyecto tiene un sistema de traducción reorganizado por módulos para facilitar el mantenimiento y actualización de traducciones.

---

## 1. Estado Actual

### 1.1 Estructura de Archivos de Idioma

- **Ubicación**: `/html/lang/`
- **Estructura nueva**: `/html/lang/{en,es,pt-BR}/` con archivos modulares
- **Compatibilidad**: Los archivos legacy (en.json, es.json, pt-BR.json) siguen funcionando

### 1.2 Módulos en /html/view/module/

- **Total de archivos PHP**: 90 módulos

### 1.3 Controladores de Email

- **Total de controladores de email**: 63 archivos
- **Ubicación**: `/html/controller/**/*correo*.php`

### 1.4 Archivos JavaScript

- **Total de archivos JS**: 44 archivos en `/html/js/`
- **Estado**: Los archivos JS usan la variable global `translations` desde PHP

---

## 2. Fases Completadas ✅

### Fase 1: Reestructurar archivos de idioma por módulo ✅

**Estructura creada**:

```
/html/lang/
├── en/
│   ├── common.json          (~200 traducciones)
│   ├── login.json
│   ├── menu.json
│   ├── clientes.json         (~100 traducciones)
│   ├── prospectos.json      (~60 traducciones)
│   ├── contratos.json
│   ├── siniestros.json
│   ├── reembolsos.json
│   ├── operatorios.json
│   ├── creditos.json
│   ├── usuarios.json
│   ├── empleados.json
│   ├── proveedores.json
│   └── facturas.json
├── es/
│   └── (misma estructura)
└── pt-BR/
    └── (misma estructura)
```

### Fase 2: Modificar modelo de idioma ✅

- Modificado `modelo_idioma.php` para cargar traducciones desde múltiples archivos
- Implementada compatibilidad hacia atrás con archivos legacy
- Carga automática de todos los módulos disponibles

### Fase 3: Consolidar traducciones en archivos JSON ✅

**Archivos actualizados con todas las traducciones necesarias**:

| Archivo          | Traducciones | Estado        |
| ---------------- | ------------ | ------------- |
| common.json      | ~200+        | ✅ Completado |
| clientes.json    | ~100+        | ✅ Completado |
| prospectos.json  | ~60+         | ✅ Completado |
| login.json       | ~10          | ✅ Completado |
| menu.json        | ~40          | ✅ Completado |
| contratos.json   | ~15          | ✅ Completado |
| siniestros.json  | ~30          | ✅ Completado |
| reembolsos.json  | ~20          | ✅ Completado |
| operatorios.json | ~20          | ✅ Completado |
| creditos.json    | ~15          | ✅ Completado |
| usuarios.json    | ~20          | ✅ Completado |
| empleados.json   | ~25          | ✅ Completado |
| proveedores.json | ~20          | ✅ Completado |
| facturas.json    | ~20          | ✅ Completado |

### Fase 4: Revisar archivos JS ✅

**Hallazgos**:

1. **Sistema de traducción JS implementado**:
   - Las traducciones se pasan desde PHP a través de la variable global `translations`
   - Hay una función `t(key, defaultValue)` disponible en JavaScript
   - Los archivos DataTables usan `translations.datatable`

2. **Textos hardcodeados encontrados** (~97 textos):
   - Principalmente en archivos de operatorios, reembolsos, créditos
   - Textos como: "Seleccione un contrato válido", "Seleccione un documento a subir", etc.
   - Estos textos están en español hardcodeado

3. **Archivos afectados**:
   - creditos-ambulatorios-\*.js
   - operatorios-\*.js
   - reembolsos-\*.js
   - siniestros-vehiculo-individual.js

---

## 3. Fases Pendientes

### Fase 5: Revisar traducciones de Emails ⏳

- Revisar los 63 controladores de email
- Verificar que todas las traducciones de emails estén disponibles

---

## 4. Uso del Sistema de Traducción

### En archivos PHP

```php
// El sistema mantiene compatibilidad hacia atrás
$t('common.name');           // funciona
$t('clientes.list_clients'); // funciona
$t('form.name');            // funciona (legacy)

// Con parámetros
$t('messages.user_status_changed', ['status' => 'actualizado']);
```

### En archivos JavaScript

```javascript
// Ya disponible globalmente
t("common.save"); // "Guardar"
t("messages.select_option"); // "Seleccione una opción..."
```

### Nueva estructura de claves por módulo

**common.json**: Traducciones generales (botones, labels, mensajes)
**clientes.json**: Gestión de clientes
**prospectos.json**: Gestión de prospectos
**login.json**: Autenticación
**menu.json**: Navegación
**contratos.json**: Contratos
**siniestros.json**: Siniestros
**reembolsos.json**: Reembolsos
**operatorios.json**: Operatorios
**creditos.json**: Créditos
**usuarios.json**: Usuarios
**empleados.json**: Empleados
**proveedores.json**: Proveedores
**facturas.json**: Facturas

---

## 5. Archivos Modificados/Creados

### Archivos JSON creados (42 total):

- 14 archivos en `/html/lang/en/`
- 14 archivos en `/html/lang/es/`
- 14 archivos en `/html/lang/pt-BR/`

### Archivo PHP modificado:

- `modelo_idioma.php` - Actualizado para cargar múltiples archivos

### Archivos JS con textos hardcodeados (recomendación):

- Para usar traducciones en JS, usar: `t('clave', 'valor por defecto')`

---

## 6. Notas

- El sistema mantiene compatibilidad total con los archivos legacy
- Los archivos PHP no necesitan cambios para usar las nuevas traducciones
- El modelo carga automáticamente traducciones de archivos modernos y legacy
- Los textos hardcodeados en JS (~97 textos) deben ser migrados gradualmente

---

## 7. Recomendaciones para Textos Hardcodeados en JS

Los textos en español hardcodeados en archivos JS pueden migrarse usando:

```javascript
// Antes (hardcodeado)
alert("Seleccione un contrato válido");

// Después (usando traducciones)
alert(t("messages.select_valid_contract", "Seleccione un contrato válido"));
```

O agregar las claves correspondientes a los archivos JSON y luego usar:

```javascript
t("js.select_valid_contract");
```

---

_Última actualización: 2026-03-05_
_Estado: Fases 1, 2, 3 y 4 completadas_
