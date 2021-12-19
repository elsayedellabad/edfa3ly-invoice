<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InvoiceDTO extends Model
{
    protected $primaryKey=null;
    protected $fillable=['subtotal', 'shippingCost', 'vat','totalShoesDiscount', 'totalJacketDiscount', 'totalShippingDiscount', 'total'];

    /**
     * Function to calculate total value of Invoice
     * 
     */
    public function setTotalValue() {
        $this->total = ( $this->subtotal + $this->shippingCost  +  $this->vat ) - ($this->totalShoesDiscount + $this->totalJacketDiscount + $this->totalShippingDiscount);
    }
}