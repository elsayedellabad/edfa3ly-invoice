<?php

namespace App\Services\DiscountChainOfResponsibility;

use App\Services\ProductsInfo;
use App\Models\InvoiceDTO;
class ShippingDiscountHandler extends AbstractDiscountHandler
{   
    /**
     * Function to calculate total shipping discount and set it in $invoiceDTO
     * 
     * @param array $cartProducts
     * @param InvoiceDTO $invoiceDTO
     * 
     */
    public function calculateDiscount($cartProducts, InvoiceDTO $invoiceDTO)
    {
        $totalShippingDiscount = 0;
        if(count($cartProducts) >= ProductsInfo::MIN_COUNT_OF_ITEMS_TO_GET_SHIPPING_DISCOUNT){
            $totalShippingDiscount = ProductsInfo::SHIPPING_DISCOUNT_VALUE;
        }
        $invoiceDTO->totalShippingDiscount = $totalShippingDiscount;
        // ok, all good, go to the next one:
        return $this->next($cartProducts, $invoiceDTO);
    }
}
?>