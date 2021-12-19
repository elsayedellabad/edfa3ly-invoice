<?php

namespace App\Utils;
use App\Constants\Constants;
class InvoiceUtil
{
  /**
   * Calculate total discount of product
   * 
   * @param number $itemCount
   * @param number $itemPrice
   * @param number $itemDiscountPercent
   * @return number $totalDiscount
   */
  public static function calcDiscount($itemCount = 1, $itemPrice = 1 , $itemDiscountPercent = 1){   
        
        $totalDiscount = 0;
        if( is_numeric($itemCount) && is_numeric($itemPrice) && is_numeric($itemDiscountPercent) ){
            $totalDiscount = $itemCount * $itemPrice * $itemDiscountPercent;
        }
        return $totalDiscount;        
        
  }


  /**
   * Calculate total Shipping cost of product
   * 
   * @param number $itemShippingRate
   * @param number $itemWeightPerGram
   * @param number $itemShippingRatePerGrams
   * @return number $totalShippingCost
   */
  public static function calcShippingCost($itemShippingRate = 1, $itemWeightPerGram = 1 , $itemShippingRatePerGrams = 1){   
        
    $totalShippingCost = 0;
    if( is_numeric($itemShippingRate) && is_numeric($itemWeightPerGram) && is_numeric($itemShippingRatePerGrams) ){
        $totalShippingCost = ($itemShippingRate *  ($itemWeightPerGram / $itemShippingRatePerGrams) );
    }
    return $totalShippingCost;        
    
}
  
}
