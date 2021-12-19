<?php

namespace App\Services\DiscountChainOfResponsibility;

use App\Services\ProductsInfo;
use App\Utils\InvoiceUtil;
use App\Models\InvoiceDTO;
class JacketDiscountHandler extends AbstractDiscountHandler
{   
    /**
     * Function to calculate total discount on Jackets of exist in cart and set it in $invoiceDTO
     * 
     * @param array $cartProducts
     * @param InvoiceDTO $invoiceDTO
     * 
     */
    public function calculateDiscount($cartProducts, InvoiceDTO $invoiceDTO) {    

        $cartProductsCounts = array_count_values($cartProducts);
        $totalJacketDiscount = 0;
        $totalTopsExistInCart = 0;         
        if(isset($cartProductsCounts['Jacket'])){
            $totalJacketsExistInCart =  $cartProductsCounts['Jacket'];
            //Calc count of tops exist in the cart
            foreach(ProductsInfo::TOPS_IN_OFFER as $top){
                if(isset($cartProductsCounts[$top])){
                    $totalTopsExistInCart += $cartProductsCounts[$top];
                }
            }
            //Validate the constraint to get Jacket Discount 
            if($totalTopsExistInCart >= ProductsInfo::COUNT_OF_TOPS_TO_GET_JACKET_DISCOUNT){                
                $jacketPrice = ProductsInfo::PRODUCTS['Jacket']['itemPrice'];
                $limit = intdiv($totalTopsExistInCart, ProductsInfo::COUNT_OF_TOPS_TO_GET_JACKET_DISCOUNT);
                //Calc Jackets discount count limit                
                $jacketDiscountLimit = ($limit > $totalJacketsExistInCart) ? $totalJacketsExistInCart : $limit;
                $totalJacketDiscount = InvoiceUtil::calcDiscount($jacketDiscountLimit, $jacketPrice, ProductsInfo::JACKET_DISCOUNT_PERCENT);
                 
            }                
        } 
        $invoiceDTO->totalJacketDiscount = $totalJacketDiscount;
        // ok, all good, go to the next one:
        return $this->next($cartProducts, $invoiceDTO);
    }
}
?>