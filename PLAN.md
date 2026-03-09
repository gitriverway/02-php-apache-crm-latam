# ESPECIFICACIONES TÉCNICAS DE CAMBIO - CRM LATAM

## 1. MÓDULO DE LOCALIZACIÓN (I18N)

**Problema:** El sistema muestra una mezcla de idiomas (Español/Portugués) y expone llaves técnicas (keys).
**Acción:** Implementar/Actualizar el diccionario para Portugués (Brasil) con las siguientes equivalencias:

### 1.1 Traducción de Labels y Formularios

| Key / Texto Actual     | Traducción Requerida (PT-BR)        |
| :--------------------- | :---------------------------------- |
| `form.origin`          | Origem do Lead                      |
| `Selecione..`          | Selecione…                          |
| `RAMO`                 | Produto / Linha                     |
| `NOVO RAMO`            | Novo produto/linha                  |
| `SEGURADORA`           | Seguradora                          |
| `PLANO DE SEGURO`      | Plano de seguro                     |
| `VALOR SEGURADO`       | Capital segurado                    |
| `PRÊMIO LÍQUIDO`       | Prêmio líquido                      |
| `PRÊMIO COMISSIONÁVEL` | Prêmio comissionável                |
| `PRÊMIO TOTAL`         | Prêmio total                        |
| `CPF / CNPJ`           | Documento (CPF / CNPJ / Passaporte) |
| `NOME`                 | Nome completo                       |
| `GÊNERO`               | Gênero                              |
| `ESTADO CIVIL`         | Estado civil                        |
| `DATA DE NASCIMENTO`   | Data de nascimento                  |
| `CIUDAD`               | Cidade                              |
| `DIRECCION DOMICILIO`  | Endereço                            |
| `Profissão`            | Profissão                           |
| `Renda`                | Renda                               |

### 1.2 Mapeo de Dropdowns (Enums)

- **Origen:** `List_tables.origin_MQP` → "Redes Sociais" / "Indicação", `List_tables.origin_chat` → "Whatsapp", `List_tables.origin_others` → "Outro".
- **Productos:** `ASISTENCIA MEDICA INDIVIDUAL` → "Saúde", `Miami` → "Travel", `Otros` → "Outros".

---

## 2. REESTRUCTURACIÓN: FORMULARIO "CREAR PROSPECTO"

### 2.1 Cambios en Validaciones (Opcionales)

Los siguientes campos deben dejar de ser obligatorios (`required: false`):

- **Documento** (CPF / CNPJ / Passaporte)
- **Profissão**
- **Endereço** (Dirección)
- **Estado civil**
- **Parentesco** (En la sección de dependientes)

### 2.2 Eliminación de Campos y Secciones

Eliminar los siguientes elementos de la UI y del esquema de datos de la pantalla:

- Campo **Renda / Ingresos**.
- Botón/Sección **"Agregar vehículo"**.
- Botón/Sección **"Agregar vivienda / hogar"**.
- En **Dependientes**: Eliminar todos los campos excepto **Nombre completo** y **Fecha de nacimiento**.

### 2.3 Campos Obligatorios (Mantener)

- Nome completo, Gênero, Data de nascimento, E-mail, Telefone.

---

## 3. LÓGICA DE NEGOCIO: ESTADOS DEL PIPELINE (STATUS)

Actualizar el campo `Status` para que refleje el flujo comercial.
**Orden de los estados:**

1. `Novo lead` (Por defecto)
2. `Em contato`
3. `Aguardando informações`
4. `Cotação enviada`
5. `Em acompanhamento`
6. `Contratado`
7. `Não interessado`
8. `Duplicado`

---

## 4. SOPORTE PARA "SEGURO DE VIAJE" (NUEVOS CAMPOS)

Agregar al formulario la siguiente lógica condicional para el producto de Viajes:

- **Tipo de viagem:** [Viagem única, Viagem anual].
- **Data de início da viagem.**
- **Data de término da viagem:** (Habilitar solo si es "Viagem única").
- **País de origem / país de saída.**
- **País de destino.**

---

## 5. REFACTORIZACIÓN: GESTIÓN DE PROVEEDORES

**Cambio de arquitectura:** Pasar de campos fijos a una lista dinámica de correos (1:N).

### 5.1 Estructura Dinámica

Sustituir los campos `E-mail Reembolsos`, `E-mail Siniestros`, etc., por una sección de **"E-mails adicionais"** donde el usuario pueda agregar múltiples filas con:

1. **E-mail:** (Input text/email).
2. **Tipo de e-mail:** (Select con las siguientes opciones):
   - Reembolso, Atendimento médico, Sinistros, Crédito hospitalar, Crédito ambulatorial, Administrativo, Outro.

**Regla técnica:** Esta sección debe ser dinámica (permitir agregar/eliminar filas) y ningún campo adicional es obligatorio.
