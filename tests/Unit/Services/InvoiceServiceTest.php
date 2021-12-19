<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\InvoiceService;
class InvoiceServiceTest extends TestCase
{       
    
    public function test_test_calcartinvoice_Function_of_Invoice_Service_using_only_one_jacket_in_cart(){
        $invoice_Service = new InvoiceService();
        $res = $this->callMethod($invoice_Service, 'calcCartInvoice', [ ['Jacket'] ]);
        $this->assertEquals($res->subtotal, 199.99);
        $this->assertEquals($res->shippingCost, 44);
        $this->assertEquals($res->vat, 27.9986);
        $this->assertEquals($res->totalShoesDiscount, 0);
        $this->assertEquals($res->totalJacketDiscount, 0);
        $this->assertEquals($res->totalShippingDiscount, 0);
        $this->assertEquals($res->total, 271.9886);
    }

    public function test_test_calcartinvoice_Function_of_Invoice_Service_using_many_products_in_cart(){
        $invoice_Service = new InvoiceService();
        $res = $this->callMethod($invoice_Service, 'calcCartInvoice', [ ["T-shirt","Blouse","Pants","Shoes","Jacket"] ]);
        $this->assertEquals($res->subtotal, 386.95);
        $this->assertEquals($res->shippingCost, 110);
        $this->assertEquals($res->vat, 54.173);
        $this->assertEquals($res->totalShoesDiscount, 7.999);
        $this->assertEquals($res->totalJacketDiscount, 99.995);
        $this->assertEquals($res->totalShippingDiscount, 10);
        $this->assertEquals($res->total, 433.129);
    }

    public function test_test_calcartinvoice_Function_of_Invoice_Service_using_one_product_not_exist_in_products_of_productinfo_Service(){
        $invoice_Service = new InvoiceService();
        $res = $this->callMethod($invoice_Service, 'calcCartInvoice', [ ["TV"] ]);
        $this->assertEquals($res->subtotal, 0);
        $this->assertEquals($res->shippingCost, 0);
        $this->assertEquals($res->vat, 0);
        $this->assertEquals($res->totalShoesDiscount, 0);
        $this->assertEquals($res->totalJacketDiscount, 0);
        $this->assertEquals($res->totalShippingDiscount, 0);
        $this->assertEquals($res->total, 0);
    }
    

    public function test_test_calcvat_function_of_Invoice_Service_by_using_subtotal_greater_than_zero(){
        $invoice_Service = new InvoiceService();
        $res = $this->callMethod($invoice_Service, 'calcVat', [386.95, .14]);
        $this->assertEquals($res, 54.173);
    }

    public function test__test_calcvat_function_of_Invoice_Service_by_using_subtotal_equal_zero(){
        $invoice_Service = new InvoiceService();
        $res = $this->callMethod($invoice_Service, 'calcVat', [0, .14]);
        $this->assertEquals($res, 0);
    }


    private function callMethod($object, string $method , array $parameters = [])
    {
        try {
            $className = get_class($object);
            $reflection = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
           throw new \Exception($e->getMessage());
        }

        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}
