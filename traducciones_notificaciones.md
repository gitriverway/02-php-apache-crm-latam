# Texto Hardcodeado en /html/controller/notificaciones

El siguiente texto está hardcodeado en los controladores de notificaciones y necesita ser traducido a los 3 idiomas.

**Nota:** Las traducciones están normalizadas usando Title Case (primera letra de cada palabra en mayúscula).

---

## Lista de Texto Actual y Traducciones

| Clave | ES (Español) | EN (Inglés) | PT-BR (Portugués BR) |
|-------|---------------|-------------|----------------------|
| accidents_pymes | Accidentes Personales Pymes | Corporate Personal Accidents | Acidentes Pessoais Empresarial |
| accidents_individual | Accidentes Personales | Personal Accidents | Acidentes Pessoais |
| medical_assistance_pymes | Asistencia Medica Pymes | Corporate Medical Assistance | Assistência Médica Empresarial |
| medical_assistance | Asistencia Medica | Medical Assistance | Assistência Médica |
| home_individual | Hogar Individual | Home Individual | Residencial Individual |
| liability_pymes | Responsabilidad Civil Pymes | Corporate Liability | Responsabilidade Civil Empresarial |
| liability | Responsabilidad Civil | Liability | Responsabilidade Civil |
| vehicle_individual | Vehiculo Individual | Vehicle Individual | Veículo Individual |
| vehicle | Vehiculo | Vehicle | Veículo |
| life_individual | Vida Individual | Life Individual | Vida Individual |
| ambulatory_credits | Creditos Ambulatorios | Ambulatory Credits | Créditos Ambulatoriais |
| hospital_credits | Creditos Hospitalarios | Hospital Credits | Créditos Hospitalares |
| list_clients_individual | Lista Clientes Individual | Individual Client List | Lista Clientes Individual |
| list_clients_pymes | Lista Clientes Pymes | Corporate Client List | Lista Clientes Pymes |
| list_clients | Lista Clientes | Client List | Lista Clientes |
| list_credit_ambulatory_pymes | Lista Credito Ambulatorio Pymes | Corporate Ambulatory Credit List | Lista Crédito Ambulatorial Pymes |
| list_credit_ambulatory | Lista Credito Ambulatorio | Ambulatory Credit List | Lista Crédito Ambulatorial |
| list_credit_hospital_pymes | Lista Credito Hospitalario Pymes | Corporate Hospital Credit List | Lista Crédito Hospitalar Pymes |
| list_credit_hospital | Lista Credito Hospitalario | Hospital Credit List | Lista Crédito Hospitalar |
| list_prospect_high | Lista Prospectos Alto Seguimiento | High Priority Prospect List | Lista Prospectos Alta Prioridade |
| list_prospect_low | Lista Prospectos Bajo Seguimiento | Low Priority Prospect List | Lista Prospectos Baixa Prioridade |
| list_prospect_individual | Lista Prospectos Individual | Individual Prospect List | Lista Prospectos Individual |
| list_prospect_medium | Lista Prospectos Medio Seguimiento | Medium Priority Prospect List | Lista Prospectos Média Prioridade |
| list_prospect_pymes_high | Lista Prospectos Pymes Alto | Corporate High Priority Prospect List | Lista Prospectos Pymes Alta |
| list_prospect_pymes_low | Lista Prospectos Pymes Bajo | Corporate Low Priority Prospect List | Lista Prospectos Pymes Baixa |
| list_prospect_pymes_medium | Lista Prospectos Pymes Medio | Corporate Medium Priority Prospect List | Lista Prospectos Pymes Média |
| list_prospect_pymes | Lista Prospectos Pymes | Corporate Prospect List | Lista Prospectos Pymes |
| list_prospect | Lista Prospectos | Prospect List | Lista Prospectos |
| list_refund_pymes | Lista Reembolso Pymes | Corporate Reimbursement List | Lista Reembolso Pymes |
| list_refund | Lista Reembolso | Reimbursement List | Lista Reembolso |
| list_claims | Lista Siniestro | Claims List | Lista Sinistros |
| refunds | Reembolsos | Reimbursements | Reembolsos |
| renewal | Renovación | Renewal | Renovação |
| no_records | Sin Registros | No Records | Sem Registros |
| claims | Siniestros | Claims | Sinistros |
| view_all_notifications | Ver Todas Las Notificaciones | View All Notifications | Ver Todas As Notificações |
| client_followup | Clientes Seguimiento | Client Follow-up | Acompanhamento Cliente |
| prospect_followup | Prospectos Seguimiento | Prospect Follow-up | Acompanhamento Prospecto |
| notifications | Notificaciones | Notifications | Notificações |
| clients | Clientes | Clients | Clientes |
| prospects | Prospectos | Prospects | Prospectos |

---

## Detalles por Tipo

### Títulos de Listas

| Clave | ES | EN | PT-BR |
|-------|-----|-----|-------|
| list_clients | Lista Clientes | Client List | Lista Clientes |
| list_prospect | Lista Prospectos | Prospect List | Lista Prospectos |
| list_claims | Lista Siniestro | Claims List | Lista Sinistros |
| list_refund | Lista Reembolso | Reimbursement List | Lista Reembolso |

### Ramos/Productos

| Clave | ES | EN | PT-BR |
|-------|-----|-----|-------|
| medical_assistance | Asistencia Medica | Medical Assistance | Assistência Médica |
| vehicle | Vehiculo | Vehicle | Veículo |
| life_individual | Vida Individual | Life Individual | Vida Individual |
| home_individual | Hogar Individual | Home Individual | Residencial Individual |
| liability | Responsabilidad Civil | Liability | Responsabilidade Civil |
| accidents_individual | Accidentes Personales | Personal Accidents | Acidentes Pessoais |

### Estados de Prospectos

| Clave | ES | EN | PT-BR |
|-------|-----|-----|-------|
| list_prospect_high | Lista Prospectos Alto Seguimiento | High Priority Prospect List | Lista Prospectos Alta Prioridade |
| list_prospect_medium | Lista Prospectos Medio Seguimiento | Medium Priority Prospect List | Lista Prospectos Média Prioridade |
| list_prospect_low | Lista Prospectos Bajo Seguimiento | Low Priority Prospect List | Lista Prospectos Baixa Prioridade |

### Otros

| Clave | ES | EN | PT-BR |
|-------|-----|-----|-------|
| no_records | Sin Registros | No Records | Sem Registros |
| view_all_notifications | Ver Todas Las Notificaciones | View All Notifications | Ver Todas As Notificações |
| notifications | Notificaciones | Notifications | Notificações |
| renewal | Renovación | Renewal | Renovação |

---

## Acción Requerida

1. Agregar estas claves a los archivos de idioma en `/html/lang/{es,en,pt-BR}/`
2. Reemplazar el texto hardcodeado en los controladores por llamadas a la función de traducción
3. Verificar que las traducciones sean correctas en cada idioma
