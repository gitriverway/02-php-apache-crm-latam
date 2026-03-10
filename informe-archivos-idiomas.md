# Informe de Archivos de Idiomas

## Resumen de Archivos por Idioma

### Español (es)

| Archivo | Líneas | Descripción |
|---------|--------|-------------|
| common.json | 732 | Archivo principal más completo |
| emails.json | 463 | Correos electrónicos |
| clientes.json | 131 | Clientes |
| form.json | 147 | Formularios (actualizado con traducciones recientes) |
| messages.json | 119 | Mensajes |
| prospectos.json | ~50 | Prospectos |
| empleados.json | 27 | Empleados |
| title.json | 24 | Títulos |
| edit_forms.json | 24 | Formularios de edición |
| list_tables.json | 22 | Tablas |
| list_modal.json | 7 | Modal |
| medical_credits.json | 19 | Créditos médicos |
| menu.json | 35 | Menú |
| operatorios.json | 18 | Operatorios |
| creditos.json | 16 | Créditos |
| facturas.json | 20 | Facturas |
| modal.json | 7 | Modal |
| options.json | 6 | Opciones |
| status.json | 7 | Estados |
| contratos.json | 13 | Contratos |
| proveedores.json | ~20 | Proveedores |
| usuarios.json | ~20 | Usuarios |
| siniestros.json | ~18 | Siniestros |
| reembolsos.json | ~18 | Reembolsos |
| login.json | 10 | Login |
| buttons.json | 11 | Botones (actualizado) |
| document_names.json | 3 | Nombres de documentos |

---

## Análisis de common.json vs form.json

### common.json (más completo)
Contiene todas las traducciones en un solo archivo, incluyendo sub-secciones:
- form
- titles  
- list_tables
- buttons
- messages
- edit_forms
- forms
- list_modal
- medical_credits
- modal
- options
- status
- table
- document_names

### form.json (modular)
Archivo independiente que fue actualizado con nuevas traducciones:
- Traducciones para prospectos
- Traducciones para clientes
- Traducciones para reembolsos
- Traducciones para siniestros
- Traducciones para créditos
- Traducciones para operatorios
- Nuevas etiquetas agregadas recientemente:
  - na, send_email, expired_status
  - max_doc_50mb, max_doc_25mb, max_image_5mb
  - enter_observation, enter_procedure_type
  - number, contract_number, provider_plan
  - table_action, table_client, table_document

---

## Observaciones

### 1. Duplicación de contenido
Existe duplicación entre:
- `common.json` (contiene form, titles, buttons, etc. anidados)
- Archivos individuales como `form.json`, `buttons.json`, `titles.json`

### 2. Etiquetas en common.json que podrían faltar en form.json
- yes, no
- active, inactive
- loading, processing, success, error, warning
- confirm
- required_field, optional
- economic_activity
- bmi_gift
- reimbursement_coverage
- satisfaction_follow_up
- etc.

### 3. Recomendaciones

1. **Unificar archivos**: Mantener un solo archivo de traducciones o mantener los archivos individuales pero sin duplicación.

2. **Estandarizar prefijos**: 
   - Usar siempre el prefijo del módulo (form., common., buttons., etc.)

3. **Completar form.json**: Agregar las etiquetas que faltan y que están en common.json

4. **Verificar traduccciones en otros idiomas**: Revisar que los archivos en `en/` y `pt-BR/` tengan las mismas etiquetas.

---

## Estado Actual de form.json

### Etiquetas actuales en form.json:
- Etiquetas básicas de formularios (~80)
- Etiquetas de prospectos (~30)
- Etiquetas de clientes (~20)
- Etiquetas de reembolsos (~20)
- Etiquetas de siniestros (~20)
- Etiquetas de créditos (~20)
- Etiquetas de operatorios (~10)
- Nuevas etiquetas agregadas (~25)

### Etiquetas faltantes que podrían necesitarse:
- yes, no (ya están en common.json)
- active, inactive
- economic_activity
- bmi_gift
- Etc.

---

*Informe generado: 10 de Marzo 2026*
