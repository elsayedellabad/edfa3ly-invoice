<?php

namespace App\Services;
use App\Constants\Constants;
class ProductsInfo
{

    const SHIPPING_RATE_PER_GRAMS = 100;
    const VAT_PERCENT = .14;
    //Shoes discount
    const SHOES_DISCOUNT_PERCENT = .1;
    //Jacket discount
    const TOPS_IN_OFFER = ['T-shirt', 'Blouse'];
    const COUNT_OF_TOPS_TO_GET_JACKET_DISCOUNT = 2;
    const JACKET_DISCOUNT_PERCENT = .5;
    //Shipping fees Discount
    const MIN_COUNT_OF_ITEMS_TO_GET_SHIPPING_DISCOUNT = 2;
    const SHIPPING_DISCOUNT_VALUE = 10;

    const SHIPPING_RATES = array(
          'US' => 2,
          'UK' => 3,
          'CN' => 2    
    );
    
    const PRODUCTS = array(
      'T-shirt' => array
      (
        'itemPrice' => 30.99,
        'shippedFrom' => 'US',
        'weight' => 0.2,
      ),
      'Blouse' => array
      (
        'itemPrice' => 10.99,
        'shippedFrom' => 'UK',
        'weight' => 0.3,
      ),
      'Pants' => array
      (
        'itemPrice' => 64.99,
        'shippedFrom' => 'UK',
        'weight' => 0.9,
      ),
      'Sweatpants' => array
      (
        'itemPrice' => 84.99,
        'shippedFrom' => 'CN',
        'weight' => 1.1,
      ),
      'Jacket' => array
      (
        'itemPrice' => 199.99,
        'shippedFrom' => 'US',
        'weight' => 2.2,
      ),
      'Shoes' => array
      (
        'itemPrice' => 79.99,
        'shippedFrom' => 'CN',
        'weight' => 1.3,
      )
    );
}
