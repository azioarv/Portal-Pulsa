#Portal Pulsa API


----------


Package for Laravel 5
[Official Documentation](http://portalpulsa.com/api-transaksi-pulsa-murah/)
##Installation
    composer require azioarv/portalpulsa
   
Add the following code to config/app.php
####Provider
```php
AzioArv\PortalPulsa\PortalPulsaServiceProvider::class
```
####Aliases
```php
'Pulsa' => AzioArv\PortalPulsa\PortalPulsaFacade::class
```
####Run This Command

    php artisan vendor publish
    
##Configuration
####.env

    PULSA_ID=<your_id>
    PULSA_KEY=<your_key>
    PULSA_SECRET=<your_secret>

##Usage
Check Saldo
```php
Pulsa::saldo();
```
Check Price Product
```php
Pulsa::cekHarga($productCode);
```
Check Status
```php
Pulsa::status($transcationID);
```
Process Transcation
```php
Pulsa::prosesPulsa($productCode,$phoneNumber,$transactionID);
```
Process PLN Transcation
```php
Pulsa::prosesPLN($productCode,$phoneNumber,$plnNumber,$transactionID);
```

Note : ``` $transcationID``` fill by your