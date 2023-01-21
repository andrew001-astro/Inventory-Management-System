## VARIABLES
PORT=9001

`Serve Project`
````
sudo php artisan serve --host 192.168.56.101 --port ${PORT}
````


## ITEMS

`List items`
````
curl -X GET "http://vmphpdv01:${PORT}/api/v1/items"
````

`Get item`
````
curl -X GET "http://vmphpdv01:${PORT}/api/v1/items/5"
````

`Create item`
````
curl -X POST "http://vmphpdv01:${PORT}/api/v1/items" \
-H 'Content-Type: application/json' \
-d '{"no":"123","name":"Laptop","price":123}'
````

`Update item`
````
curl -X PUT "http://vmphpdv01:${PORT}/api/v1/items/44" \
-H 'Content-Type: application/json' \
-d '{"no":"789"}'
````

`Delete item`
````
curl -X DELETE "http://vmphpdv01:${PORT}/api/v1/items/5"
````





## INVOICES

`Update invoice`
````
curl -X PUT "http://vmphpdv01:${PORT}/api/v1/invoices/3" \
-H 'Content-Type: application/json' \
-d '{"no":"789"}'
````

`Create invoice`
````
curl -X POST "http://vmphpdv01:${PORT}/api/v1/invoices" \
-H 'Content-Type: application/json' \
-d '
{
    "referenceNo":"REFTEST123",
    "senderId":"1",
    "recipientName":"Juan DelaCruz",
    "recipientAddress":"Address ito",
    "subTotal":10000,
    "taxRate":10,
    "taxAmount":1000,
    "total":10000,
    "amountPaid":10000,
    "amountDue":0,
    "notes":"This is notes"
}
'
````

`List invoices`
````
curl -X GET "http://vmphpdv01:${PORT}/api/v1/invoices"
````

`Get invoice`
````
curl -X GET "http://vmphpdv01:${PORT}/api/v1/invoices/6"
````

`Update invoice`
````
curl -X PUT "http://vmphpdv01:${PORT}/api/v1/invoices/6" \
-H 'Content-Type: application/json' \
-d '
{
    "referenceNo":"UPDATEREF456",
    "recipientAddress": "UPDATE ADDRESS NANAMAN"
}
'
````

`Delete invoice`
````
curl -X DELETE "http://vmphpdv01:${PORT}/api/v1/invoices/6"
````



## ITEM INVOICE

`Update invoice items`
````
curl -X PUT "http://vmphpdv01:${PORT}/api/v1/invoice-items/1" \
-H 'Content-Type: application/json' \
-d '
{
    "itemId":22,
    "invoiceId":55
}
'
````

`Create invoice items`
````
curl -X POST "http://vmphpdv01:${PORT}/api/v1/invoice-items" \
-H 'Content-Type: application/json' \
-d '
{
    "itemId":1,
    "invoiceId":1,
    "quantity":1,
    "total":1
}
'
````

`List invoice items`
````
curl -X GET "http://vmphpdv01:${PORT}/api/v1/invoice-items"
````

`Get invoice items`
````
curl -X GET "http://vmphpdv01:${PORT}/api/v1/invoice-items/1"
````