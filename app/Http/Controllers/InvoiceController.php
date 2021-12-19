<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constants\Constants;
use App\Exceptions\FunctionalException;
use App\Services\InvoiceService;
use App\Models\InvoiceDTO;
class InvoiceController extends Controller
{
    private $invoiceService;
    public function __construct(InvoiceService $invoiceService) {
        $this->invoiceService = $invoiceService;
    }
    /**
     * Main API to calculate cart invoice
     * 
     * @return object json of all invoice details
     */
    public function index(Request $request){ 
        $post =  json_decode($request->getContent());        
        $cartProducts = $post->{'items'};
        if(!isset($cartProducts) || count($cartProducts) == 0){
            throw new FunctionalException(Constants::NO_PRODUCTS_IN_CART_WARNINIG);
        }
        $invoideDTO = $this->invoiceService->calcCartInvoice($cartProducts);
        return $this-> buildInvoiceResponse($invoideDTO);
    }

    private function buildInvoiceResponse(InvoiceDTO $invoiceDTO) {
        return  response()->json([                
            'subTotal' => "$".$invoiceDTO->subtotal,
            'shipping' => "$".$invoiceDTO->shippingCost,
            'vat' => "$".$invoiceDTO->vat,
            "discount" => array(
                "shoesDiscount" => "-$".$invoiceDTO->totalShoesDiscount,
                "jacketDiscount" => "-$".$invoiceDTO->totalJacketDiscount,
                "shippingDiscount" => "-$".$invoiceDTO->totalShippingDiscount
            ),
            'total' => "$".$invoiceDTO->total
       ], 200);
    }

}
