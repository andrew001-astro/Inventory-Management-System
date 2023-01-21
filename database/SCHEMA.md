# users table
|Name|Type|Attributes|
|---|---|---|
|`id`|int|AI|
|`name`|String|not null|
|`role`|String|null|
|`address`|String|null|
|`contact_no`|String|null|
|`password`|String|not null, encrypted|
|`email`|String|not null,unique|



# items table
|Name|Type|Attributes|
|---|---|---|
|`id`|int|AI|
|`no`|String|not null, unique|
|`name`|String|not null|
|`price`|double|null|



# invoices table
|Name|Type|Attributes|
|---|---|---|
|`id`|int|AI|
|`reference_no`|String|not null, auto-gen|
|`sender_id`|String|not null|
|`recipient_name`|String|not null|
|`recipient_address`|String|not null|
|`sub_total`|double|null|
|`tax_rate`|float|null|
|`tax_amount`|double|null|
|`total`|double|null|
|`amount_paid`|double|null|
|`amount_due`|double|null|
|`notes`|String|null|



# items_invoices table
|Name|Type|Attributes|
|---|---|---|
|`id`|int|AI|
|`item_id`|int|not null|
|`invoice_id`|int|not null|
|`quantity`|int|null|
|`total`|double|null|