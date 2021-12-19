# Edfa3ly-Invoice-Task
Backend API for "Calculating Invoice of the cart with applying discounts offers" by using Laravel Framework [V-8].

## Challenge Description

***Write a program that can price a cart of products from different countries, accept multiple products, combine offers, and display a total detailed invoice in USD as well.

Available catalog products and their respective price in USD (regardless of the shipping country):

* T-shirt    $30.99     >> Shipped from [US]  >>  Weight [0.2kg]
* Blouse     $10.99     >> Shipped from [UK]  >>  Weight [0.3kg]
* Pants      $64.99     >> Shipped from [UK]  >>  Weight [0.9kg]
* Sweatpants $84.99     >> Shipped from [CN]  >>  Weight [1.1kg]
* Jacket     $199.99    >> Shipped from [US]  >>  Weight [2.2kg]
* Shoes      $79.99     >> Shipped from [CN]  >>  Weight [1.3kg]  

* Each country has a shipping rate per 100 grams

Shipping rates:

* US  >> $2
* UK  >> $3
* CN  >> $2

The program can handle some special offers, which affect the pricing.

Available offers:

* Shoes are on 10% off.
* Buy any two tops (t-shirt or blouse) and get any jacket half its price.
* Buy any two items or more and get a maximum of $10 off shipping fees.

*There is a 14% VAT (before discounts) applied to all products, whatever the shipping country is.

The program accepts a list of products, outputs the detailed invoice of the subtotal (sum of items prices), shipping fees, VAT, and discounts if applicable.


e.g.

Adding the following products:

```
T-shirt
Blouse
Pants
Shoes
Jacket
```

Outputs the following invoice:

```
Subtotal: $386.95
Shipping: $110
VAT: $54.173
Discounts:
	10% off shoes: -$7.999
	50% off jacket: -$99.995
	$10 of shipping: -$10
Total: $433.129
```

Another, e.g., If none of the offers are eligible by adding one product:

```
Jacket
```
Outputs the following invoice:

```
Subtotal: $199.99
Shipping: $44
VAT: $27.9986
Total: $271.9886
```




### Server Requirments

WAMP/XAMP server which have the following packages enabled:

- PHP >= 7.4.0
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### Install Composer Dependency Manager for PHP:

- You can download it from https://getcomposer.org/

### Installation steps:

1- Apply the following commands after opening CMD from the root path of your server as ex.[C:/wamp64/www/]:

```sh
git clone https://github.com/elsayedellabad/edfa3ly-invoice.git
cd edfa3ly-invoice
composer install
```

2- Now you should be able to access our API app from Postman:

```sh
http://localhost/edfa3ly-invoice/public/api/invoice/cart
```

### Running Tests by using the following command:
```sh
php artisan test
```

## Logging & Error Handling

Application have well error handling if it happend