<?php

namespace App\Services\DiscountChainOfResponsibility;
use App\Models\InvoiceDTO;

interface DiscountHandlerInterface
{
   /** set the next handler: */
    public function setNext(DiscountHandlerInterface $next);
    /** run this handler's code */
    public function calculateDiscount($cartProducts, InvoiceDTO $invoiceDTO);
    /** run the next handler  */
    public function next($cartProducts, InvoiceDTO $invoiceDTO);
}
?>