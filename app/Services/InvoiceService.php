<?php

namespace App\Services;
use App\Services\ProductsInfo as ProductsInfo;
use App\Constants\Constants;
use App\Utils\InvoiceUtil;
use App\Models\InvoiceDTO;
use App\Services\DiscountChainOfResponsibility\ShoesDiscountHandler;
use App\Services\DiscountChainOfResponsibility\JacketDiscountHandler;
use App\Services\DiscountChainOfResponsibility\ShippingDiscountHandler;

class InvoiceService
{   
    /**
     * Main Function to calculate cart invoice
     * 
     * @param array $cartProducts
     * @return InvoiceDTO $invoiceDTO
     */
    public function calcCartInvoice($cartProducts) : InvoiceDTO{
        $subtotal = 0;
        $shippingCost = 0;
        //Calc SubTotal and Shipping Cost
        foreach($cartProducts as $product){
            if(isset(ProductsInfo::PRODUCTS[$product])){
                //Calc SubTotal
                $subtotal += ProductsInfo::PRODUCTS[$product]['itemPrice'];
                //Calc Shipping Cost
                $productShippedFrom = ProductsInfo::PRODUCTS[$product]['shippedFrom'];
                $productShippingRate = ProductsInfo::SHIPPING_RATES[$productShippedFrom];
                $shippingCost += InvoiceUtil::calcShippingCost($productShippingRate , ProductsInfo::PRODUCTS[$product]['weight'] * 1000, ProductsInfo::SHIPPING_RATE_PER_GRAMS);
            }
        }
        //Calc VAT value
        $vat = $this->calcVat($subtotal, ProductsInfo::VAT_PERCENT);
        $invoiceDTO = new InvoiceDTO([
            'subtotal'=>$subtotal,
            'shippingCost'=>$shippingCost,
            'vat'=>$vat
        ]);
        //Calc all possible discounts values by applying Chain of Responsibilities Design Pattern
        $discountChainHandler = $this->buildDiscountChain();
        $discountChainHandler->calculateDiscount($cartProducts, $invoiceDTO);
        $invoiceDTO->setTotalValue();
        return $invoiceDTO;
    }

    /**
     * Function to Build discount chain execution order to calculate all possible discounts values
     * 
     * @return ShoesDiscountHandler first element in chain execution
     */
    private function buildDiscountChain() {
        
        $shoesDiscountHandler = new ShoesDiscountHandler();
        $jacketDiscountHandler = new JacketDiscountHandler();
        $shippingDiscountHandler = new ShippingDiscountHandler();
        
        $shoesDiscountHandler->setNext($jacketDiscountHandler);
        $jacketDiscountHandler->setNext($shippingDiscountHandler);
        return $shoesDiscountHandler;
    }

    /**
     * Function to calculate VAT value of cart subtotal
     * 
     * @param number $subtotal
     * @param number $vatPercent
     * @return number
     */
    private function calcVat($subtotal, $vatPercent){

        $vatValue = 0;
        if(isset($subtotal) && $subtotal > 0){ 
            $vatValue =  $subtotal * $vatPercent;           
        }
        return $vatValue;
    }
     
}
