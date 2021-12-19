<?php

namespace App\Services\DiscountChainOfResponsibility;
use App\Models\InvoiceDTO;

abstract class AbstractDiscountHandler implements DiscountHandlerInterface
{
    // the next one to process after this
    /** @var  DiscountHandlerInterface */
    protected $next;
    /** set the next handler */
    public function setNext(DiscountHandlerInterface $next)
    {
        $this->next = $next;
    }
    /** run the next handler */
    public function next($cartProducts, InvoiceDTO $invoiceDTO)
    {
        if ($this->next) {
            // go to next one:
            return $this->next->calculateDiscount($cartProducts, $invoiceDTO);
        }
        // else, no more to do
    }

}

?>