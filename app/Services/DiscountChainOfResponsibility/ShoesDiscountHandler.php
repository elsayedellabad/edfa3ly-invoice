<?php

namespace App\Services\DiscountChainOfResponsibility;

use App\Services\ProductsInfo;
use App\Utils\InvoiceUtil;
use App\Models\InvoiceDTO;
class ShoesDiscountHandler extends AbstractDiscountHandler
{   
    /**
     * Function to calculate total discount on shoes exist in cart and set it in $invoiceDTO
     * 
     * @param array $cartProducts
     * @param InvoiceDTO $invoiceDTO
     * 
     */
    public function calculateDiscount($cartProducts, InvoiceDTO $invoiceDTO)
    {
        $cartProductsCounts = array_count_values($cartProducts);
        $totalShoesDiscount = 0;
        $shoesPrice = ProductsInfo::PRODUCTS['Shoes']['itemPrice'];
        if(isset($cartProductsCounts['Shoes'])){
            $totalShoesCount =  $cartProductsCounts['Shoes'];
            $totalShoesDiscount = InvoiceUtil::calcDiscount($totalShoesCount, $shoesPrice, ProductsInfo::SHOES_DISCOUNT_PERCENT);
        }  
        $invoiceDTO->totalShoesDiscount = $totalShoesDiscount;
        // ok, all good, go to the next one:
        return $this->next($cartProducts, $invoiceDTO);
    }
}
?>