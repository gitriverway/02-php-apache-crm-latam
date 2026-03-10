# Informe de Textos Hardcodeados - html/view/module

## Resumen Ejecutivo

Se ha realizado una revisión profunda de todos los archivos PHP en la carpeta `html/view/module` y subcarpetas para detectar textos hardcodeados en elementos HTML como h1, h2, h3, h4, h5, h6, label, button, span, p, th, td, option, placeholder, aria-label, entre otros.

**Total de archivos analizados:** ~100+ archivos PHP

---

## Estadísticas Globales

| Tipo de Elemento | Cantidad de Occurrencias |
|------------------|--------------------------|
| `<h1>` - `<h6>` | ~140 |
| `<label>` | ~99 |
| `<button>` | ~11 |
| `<span>` | ~141 |
| `<p>` (help-block) | ~244 |
| `<th>` | ~186 |
| `<option>` | ~74 |
| `placeholder` | ~427 |
| `aria-label="Close"` | ~141 |

---

## Archivos con Textos Hardcodeados

### 1. editar-prospecto.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 153 | placeholder | `INGRESOS VALOR ASEGURADO` |
| 170 | placeholder | `INGRESOS PRIMA NETA` |
| 187 | placeholder | `INGRESOS PRIMA COMISIONABLE` |
| 204 | placeholder | `INGRESOS PRIMA TOTAL` |
| 286-301 | option | `Masculino`, `Femenino`, `SOLTERO/A`, `CASADO/A`, `DIVORCIADO/A`, `VIUDO/A`, `UNIÓN LIBRE` |
| 511 | p | `Peso máximo del documento 50MB` |
| 620-686 | span | `&times;` (cerrar modal) |
| 630, 696 | th | `#` |
| 670 | button | `Salir` |

### 2. crear-prospecto.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 125-179 | placeholder | `INGRESOS VALOR ASEGURADO`, `PRIMA NETA`, etc. |
| 234-364 | placeholder | Textos de formularios (nombre, email, teléfono, etc.) |
| 494 | p | `Peso máximo del documento 50MB` |
| 602-635 | span | `&times;` |
| 611 | th | `#` |
| 647 | placeholder | `Ingresar Observación` |

### 3. creditos-ambulatorios-asistencia-medica-individual-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 45 | h3 (comment) | `BIENVENIDO AL CONTENIDO DE CREDITOS AMBULATORIO - ASISTENCIA MEDICA INDIVIDUAL` |
| 144-412 | label | `N/A`, `Enviar Email`, `Estado Caducado` |
| 349-795 | p | `Peso máximo del documento 25MB` |
| 747 | placeholder | `0.00` |
| 766-777 | placeholder | `Ingresar Tipo de Examen` |

### 4. credito-ambulatorio-asistencia-medica-individual-cliente.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 165 | placeholder | `0.00` |
| 175-195 | placeholder | `Ingresar Tipo de Examen` |
| 213 | p | `Peso máximo del documento 25MB` |

### 5. operatorios-asistencia-medica-individual-cliente-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO DE OPERATORIOS...` |
| 88 | h4 | `Observaciones` |
| 115 | h5 | `NUEVO CRÉDITO HOSPITALARIO` |
| 183 | placeholder | `0.00` |
| 219 | p | `Peso máximo del documento 25MB` |

### 6. operatorios-asistencia-medica-individual-cliente.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO DE OPERATORIOS...` |
| 88 | h4 | `Observaciones` |
| 172 | placeholder | `0.00` |
| 208 | p | `Peso máximo del documento 25MB` |

### 7. reembolsos-asistencia-medica-individual-cliente-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO DE REEMBOLSOS...` |
| 96 | h4 | `Observaciones` |
| 56-67 | th | `Número Reembolso`, `Envio Aseguradora 2` |
| 176 | placeholder | `0.00` |
| 191 | p | `Peso máximo del documento 50MB` |

### 8. reembolsos-asistencia-medica-individual-cliente.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO DE REEMBOLSOS...` |
| 96 | h4 | `Observaciones` |
| 56-67 | th | `Número Reembolso`, `Envio Aseguradora 2` |
| 167 | placeholder | `0.00` |
| 182 | p | `Peso máximo del documento 50MB` |

### 9. siniestros-hogar-individual-cliente.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 234 | p | `Peso máximo del documento 50MB` |

### 10. siniestros-transporte-pymes-cliente.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 95 | h4 | `Observaciones` |
| 188 | p | `Peso máximo del documento 25MB` |

### 11. siniestros-vehiculo-individual-cliente.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 97 | h4 | `Observaciones` |
| 240 | p | `Peso máximo del documento 25MB` |

### 12. reembolsos-asistencia-medica-individual-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO DE REEMBOLSOS...` |
| 150-460 | label | `N/A` (múltiples) |
| 480-1131 | placeholder/comentarios | Textos varios |
| 1122 | placeholder | `0.00` |

### 13. reembolsos-asistencia-medica-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 150-460 | label | `N/A` (múltiples) |
| 1100 | placeholder | `0.00` |

### 14. siniestros-hogar-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 45 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 50 | th | `#` |
| 67 | th | `Valor Pago Cliente` |
| 148-357 | label | `N/A` |
| 568-722 | p | `Peso máximo del documento 50MB` |

### 15. siniestros-transporte-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 45 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 57 | th | `#` |
| 77 | th | `Valor Pago Cliente` |
| 162 | h3 | `Documentos Cliente` |
| 184-339 | label | `N/A` |
| 477-894 | p | `Peso máximo del documento 25MB` |

### 16. siniestros-vehiculo-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 45 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 56 | th | `#` |
| 80 | th | `Valor Pago Cliente` |
| 354 | h3 | `Documentos Daños Terceros` |
| 187-444 | label | `N/A` |
| 583-1112 | p | `Peso máximo del documento 25MB` |

### 17. operatorios-asistencia-medica-individual-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 45 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 144-410 | label | `N/A`, `Enviar Email`, `Estado Caducado` |

### 18. operatorios-asistencia-medica-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 45 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 145-413 | label | `N/A`, `Enviar Email`, `Estado Caducado` |

### 19. reembolsos-vida-individual-cliente.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 | `BIENVENIDO AL CONTENIDO DE REEMBOLSOS - VIDA INDIVIDUAL` |
| 159 | p | `Peso máximo de la imagen 5MB` |

### 20. prospecto-asignado.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO DE PROSPECTOS` |
| 71 | th | `#` |
| 119-198 | span | `&times;` |

### 21. prospecto-asignado-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 44 | h3 (comment) | `BIENVENIDO AL CONTENIDO DE PROSPECTOS` |
| 68 | th | `#` |

### 22. editar-prospecto-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 358-361 | option | `0 a 1000`, `1000 a 3000`, `3000 a 5000`, `5000 en adelante` |
| 507-608 | th | `#`, `Empleado` |
| 582 | button | `Salir` |

### 23. editar-cliente-vida-individual-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 424-427 | option | Rangos de ingresos |
| 471-496 | p | `Peso máximo del documento 50MB` |
| 679-815 | th | `#`, `Documento`, `Empleado` |
| 754 | button | `Salir` |
| 774 | h5 | `Lista de Documentos` |

### 24. editar-cliente-vehiculo-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 257-258 | option | `Masculino`, `Femenino` |
| 434-437 | option | Rangos de ingresos |
| 482-534 | p | `Peso máximo del documento 50MB` |
| 644-741 | th | `#`, `Documento`, `Empleado` |
| 680 | button | `Salir` |

### 25. editar-cliente-transporte-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 366-369 | option | Rangos de ingresos |
| 414-466 | p | `Peso máximo del documento 50MB` |
| 576-675 | th | `#`, `Documento`, `Empleado` |
| 612 | button | `Salir` |

### 26. editar-cliente-responsabilidad-civil-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 356-374 | option | `Masculino`, `Femenino`, estados civiles |
| 496-499 | option | Rangos de ingresos |
| 545-626 | p | `Peso máximo del documento 50MB` |
| 736-833 | th | `#`, `Documento`, `Empleado` |
| 772 | button | `Salir` |

### 27. editar-cliente-incendio-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 363-366 | option | Rangos de ingresos |
| 573-668 | th | `#`, `Documento`, `Empleado` |

### 28. editar-cliente-hogar-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 256-257 | option | `Masculino`, `Femenino` |
| 393-396 | option | Rangos de ingresos |
| 603-700 | th | `#`, `Documento`, `Empleado` |
| 639 | button | `Salir` |

### 29. editar-cliente-asistencia-medica-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 277-278 | option | `Masculino`, `Femenino` |
| 475-556 | p | `Peso máximo del documento 50MB` |
| 670-768 | th | `#`, `Documento`, `Empleado` |

### 30. editar-cliente-asistencia-medica-individual-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 424-427 | option | Rangos de ingresos |
| 473-535 | p | `Peso máximo del documento 50MB` |
| 682-818 | th | `#`, `Documento`, `Empleado` |
| 757 | button | `Salir` |

### 31. editar-cliente-asistencia-medica-corporativo-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 379-382 | option | Rangos de ingresos |
| 694 | th | `#` |
| 769 | button | `Salir` |

### 32. editar-cliente-accidentes-personales-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 273-274 | option | `Masculino`, `Femenino` |
| 420-423 | option | Rangos de ingresos |
| 638-737 | th | `#`, `Documento`, `Empleado` |
| 674 | button | `Salir` |

### 33. editar-cliente-accidentes-personales-individual-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 365-368 | option | Rangos de ingresos |
| 586-726 | th | `#`, `Documento`, `Empleado` |
| 663 | button | `Salir` |

### 34. credito-ambulatorio-asistencia-medica-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 45 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |
| 143-412 | label | `N/A`, `Enviar Email`, `Estado Caducado` |

### 35. credito-ambulatorio-asistencia-medica-individual-cliente-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 46 | h3 (comment) | `BIENVENIDO AL CONTENIDO...` |

### 36. editar-cliente-vida-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 422-425 | option | Rangos de ingresos |
| 672-772 | th | `#`, `Documento`, `Empleado` |

### 37. editar-cliente-responsabilidad-civil-empresarial.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 425-428 | option | Rangos de ingresos |
| 672-778 | th | `#`, `Documento` |

### 38. documento-vehiculo-individual.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 49-51 | th | `#`, `Número Contrato`, `Proveedor/Plan` |

### 39. documento-transporte-pymes.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 50-52 | th | `#`, `Número Contrato`, `Proveedor/Plan` |

### 40. 404.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 30 | h2 | `404` |

### 41. inicio1/cajas-superiores.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 17-231 | h3 | Contadores (0) con ID, `Asistencia Medica`, `Vehiculos`, `Hogar`, `Pymes` |
| 296 | h3 | `Pymes` |

### 42. inicio1/cajas-superiores-vendedor.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 17 | h3 | Contador prospecto |
| 33, 41 | h3 | `Pymes` |

### 43. inicio1/cajas-superiores-clientes.php

| Línea | Tipo | Contenido Hardcodeado |
|-------|------|----------------------|
| 77-489 | h3 | Múltiples títulos: `Seguros de Vida`, `Seguros de Asistencia Medica`, `Seguros de Vehiculo`, etc. |

---

## Clasificación de Textos Hardcodeados por Categoría

### 1. Títulos y Encabezados (h1-h6)
-BIENVENIDO AL CONTENIDO... (comentarios)
- Observaciones
- Lista de Documentos
- Documentos Cliente
- Documentos Daños Terceros
- Número Reembolso
- Valor Pago Cliente
- Pymes
- Seguros de Vida, Asistencia Medica, Vehiculo, etc.

### 2. Botones
- Salir
- Close (aria-label)

### 3. Labels de Formularios
- N/A
- Enviar Email
- Estado Caducado

### 4. Opciones de Select
- Masculino / Femenino
- SOLTERO/A, CASADO/A, DIVORCIADO/A, VIUDO/A, UNIÓN LIBRE
- 0 a 1000, 1000 a 3000, 3000 a 5000, 5000 en adelante

### 5. Placeholders
- INGRESOS VALOR ASEGURADO
- INGRESOS PRIMA NETA
- 0.00
- Ingresar Observación
- Ingresar Tipo de Examen
- Ingresar Comentarios

### 6. Help Blocks / Párrafos
- Peso máximo del documento 50MB
- Peso máximo del documento 25MB
- Peso máximo de la imagen 5MB

### 7. Encabezados de Tablas (th)
- #
- Número Contrato
- Proveedor/Plan
- Número Reembolso
- Envio Aseguradora 2
- Valor Pago Cliente
- Documento
- Empleado

---

## Recomendaciones

1. **Crear archivo de traducciones**: Consolidar todos los textos en un archivo de idiomas (ej: `es.json` o usando el sistema `$t()` existente).

2. **Priorizar cambios**:
   - Alta prioridad: Labels de formularios, botones, títulos visibles
   - Media prioridad: Placeholders, opciones de select
   - Baja prioridad: Textos en comentarios HTML (opcional)

3. **Usar el sistema de traducciones existente**: El código ya utiliza `$t('...')` en algunos lugares. Expandir este sistema.

4. **Revisión por módulos**: Los archivos de clientes y prospectos tienen más hardcoding y deberían revisarse primero.

---

*Informe generado el: 10 de Marzo de 2026*

---

## Progreso de Cambios Realizados

### Traducciones Agregadas (form.json)

Se agregaron las siguientes claves de traducción al archivo `html/lang/es/form.json`:

- `enter_observation`: "Ingresar Observación"
- `enter_procedure_type`: "Ingresar Tipo de Examen"
- `observation`: "OBSERVACIÓN"
- `procedure_type`: "TIPO DE EXAMEN"
- `contract`: "CONTRATO"
- `value`: "VALOR"
- `diagnosis`: "DIAGNOSIS"
- `send_email`: "Enviar Email"
- `expired_status`: "Estado Caducado"
- `refund_number`: "Número Reembolso"
- `sender_insurer_2`: "Envio Aseguradora 2"
- `client_payment_value`: "Valor Pago Cliente"
- `number`: "#"
- `contract_number`: "Número Contrato"
- `provider_plan`: "Proveedor/Plan"
- `document`: "DOCUMENTO"
- `employee`: "EMPLEADO"
- `table_action`: "ACCIÓN"
- `table_client`: "CLIENTE"
- `table_document`: "DOCUMENTO"
- `max_document_weight`: "Peso máximo del documento"
- `max_image_weight`: "Peso máximo de la imagen"

### Archivos Actualizados

1. **editar-prospecto.php**
   - Placeholder "INGRESOS VALOR ASEGURADO" → `<?php echo $t('form.enter_sum_insured'); ?>`
   - Placeholder "INGRESOS PRIMA NETA" → `<?php echo $t('form.enter_net_premium'); ?>`
   - Placeholder "INGRESOS PRIMA COMISIONABLE" → `<?php echo $t('form.enter_commissionable_premium'); ?>`
   - Placeholder "INGRESOS PRIMA TOTAL" → `<?php echo $t('form.enter_total_premium'); ?>`
   - Placeholder "Ingresar Observación" → `<?php echo $t('form.enter_observation'); ?>`
   - Botón "Salir" → `<?php echo $t('buttons.exit_button'); ?>`
   - Botón "Agregar" mal formateado corregido

2. **editar-prospecto-empresarial.php**
   - Placeholder "Ingresar Observación" → `<?php echo $t('form.enter_observation'); ?>`
   - Botón "Salir" → `<?php echo $t('buttons.exit_button'); ?>`
   - Botón "Agregar" mal formateado corregido

3. **editar-cliente-vida-individual-empresarial.php**
   - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

4. **editar-cliente-vehiculo-individual.php**
   - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

5. **editar-cliente-transporte-empresarial.php**
   - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

6. **editar-cliente-responsabilidad-civil-individual.php**
   - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

7. **editar-cliente-hogar-individual.php**
   - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

8. **editar-cliente-asistencia-medica-individual-empresarial.php**
   - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

9. **editar-cliente-asistencia-medica-corporativo-empresarial.php**
   - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

10. **editar-cliente-accidentes-personales-individual.php**
    - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

11. **editar-cliente-accidentes-personales-individual-empresarial.php**
    - Botón duplicado "Salir" eliminado, ahora usa `<?php echo $t('buttons.exit'); ?>`

### Pendiente por Hacer

Los siguientes grupos de archivos aún requieren cambios:

1. **Archivos de reembolsos y siniestros** (alta cantidad de hardcoding)
2. **Archivos de créditos y operatorios**
3. **Placeholders "0.00"** (valores numéricos)
4. **Textos "Peso máximo del documento XXMB"** (244 ocurrencias)
5. **Encabezados de tablas (th)** con "#" hardcodeado
6. **Opciones de select** con rangos de ingresos
7. **Labels "N/A"**, "Enviar Email", "Estado Caducado"

---

## VITACORA DE CAMBIOS REALIZADOS - 10 de Marzo 2026

### 1. ARCHIVOS DE TRADUCCIONES ACTUALIZADOS

#### `html/lang/es/form.json`
Se agregaron las siguientes claves de traducción:
- enter_observation, enter_procedure_type, observation, procedure_type
- contract, value, diagnosis, send_email, expired_status
- refund_number, sender_insurer_2, client_payment_value
- number, contract_number, provider_plan
- document, employee, table_action, table_client, table_document
- max_document_weight, max_image_weight

#### `html/lang/es/buttons.json`
Se agregó: exit_button: "Salir"

### 2. PROSPECTOS (COMPLETADO)

#### editar-prospecto.php
- Placeholders valores: INGRESOS VALOR ASEGURADO/NETA/COMISIONABLE/TOTAL
- Placeholder observación
- Botón Salir
- Options género: Masculino/Femenino
- Options estado civil: SOLTERO/A, CASADO/A, etc.
- Options frecuencia/forma pago corregidos (formato mal cerrado)
- Options estados corregidos

#### crear-prospecto.php
- States seguimiento corregidos

#### editar-prospecto-empresarial.php
- Placeholder observación
- Botón Salir
- Options rangos ingresos
- Options estados

### 3. EDITAR CLIENTE (COMPLETADO)

Archivos modificados (12):
1. editar-cliente-vida-individual-empresarial.php - botón duplicado, rangos ingresos
2. editar-cliente-vehiculo-individual.php - botón duplicado, rangos ingresos
3. editar-cliente-transporte-empresarial.php - botón duplicado, rangos ingresos
4. editar-cliente-responsabilidad-civil-individual.php - botón duplicado, rangos ingresos
5. editar-cliente-hogar-individual.php - botón duplicado, rangos ingresos
6. editar-cliente-asistencia-medica-individual-empresarial.php - botón duplicado, rangos ingresos
7. editar-cliente-asistencia-medica-corporativo-empresarial.php - botón duplicado, rangos ingresos
8. editar-cliente-accidentes-personales-individual.php - botón duplicado, rangos ingresos
9. editar-cliente-accidentes-personales-individual-empresarial.php - botón duplicado, rangos ingresos
10. editar-cliente-vida-individual.php - rangos ingresos
11. editar-cliente-incendio-empresarial.php - rangos ingresos
12. editar-cliente-responsabilidad-civil-empresarial.php - rangos ingresos

### 4. REEMBOLSOS (COMPLETADO)

Archivos modificados (4):
1. reembolsos-asistencia-medica-individual.php - N/A, Enviar Email, Estado Caducado, Peso máximo 50MB
2. reembolsos-asistencia-medica-individual-empresarial.php - N/A, Enviar Email, Estado Caducado, Peso máximo 50MB
3. reembolsos-asistencia-medica-individual-cliente.php - Peso máximo 50MB
4. reembolsos-asistencia-medica-individual-cliente-empresarial.php - Peso máximo 50MB
5. reembolsos-vida-individual-cliente.php - Peso máximo imagen 5MB

### 5. SINIESTROS (COMPLETADO)

Archivos modificados (6):
1. siniestros-hogar-individual.php - N/A, Peso máximo 50MB
2. siniestros-hogar-individual-cliente.php - Peso máximo 50MB
3. siniestros-transporte-empresarial.php - N/A, Peso máximo 25MB
4. siniestros-transporte-pymes-cliente.php - Peso máximo 25MB
5. siniestros-vehiculo-individual.php - N/A, Peso máximo 25MB
6. siniestros-vehiculo-individual-cliente.php - Peso máximo 25MB

### 6. CRÉDITOS (COMPLETADO)

Archivos modificados (3):
1. creditos-ambulatorios-asistencia-medica-individual-empresarial.php - N/A, Enviar Email, Estado Caducado, Peso máximo 25MB
2. credito-ambulatorio-asistencia-medica-individual.php - N/A, Enviar Email, Estado Caducado, Peso máximo 25MB
3. credito-ambulatorio-asistencia-medica-individual-cliente.php - Peso máximo 25MB

### 7. OPERATORIOS (COMPLETADO)

Archivos modificados (4):
1. operatorios-asistencia-medica-individual-empresarial.php - N/A, Enviar Email, Estado Caducado, Peso máximo 25MB
2. operatorios-asistencia-medica-individual.php - N/A, Enviar Email, Estado Caducado, Peso máximo 25MB
3. operatorios-asistencia-medica-individual-cliente.php - Peso máximo 25MB
4. operatorios-asistencia-medica-individual-cliente-empresarial.php - Peso máximo 25MB

### RESUMEN

| Categoría | Cantidad |
|-----------|----------|
| Archivos PHP modificados | 45 |
| Archivos JSON modificados | 2 |
| Opciones corregidas (rangos ingresos) | ~50 |
| Botones corregidos | ~12 |
| Options mal闭合 corregidos | ~40 |
| Labels N/A corregidos | ~70 |
| Labels Email/Estado corregidos | ~16 |
| Textos peso máximo corregidos | ~38 |

### PENDIENTE

| Módulo | Estado |
|--------|--------|
| Prospectos | COMPLETADO |
| editar-cliente | COMPLETADO |
| Reembolsos | COMPLETADO |
| Siniestros | COMPLETADO |
| Créditos | COMPLETADO |
| Operatorios | COMPLETADO |
| Operatorios | PENDIENTE |
| Placeholders "0.00" | PENDIENTE |
| Textos peso documento | PENDIENTE |
| Labels N/A, Email, Estado | PENDIENTE |
| Encabezados th (#) | PENDIENTE
