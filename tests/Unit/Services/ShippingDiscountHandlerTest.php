<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\DiscountChainOfResponsibility\ShippingDiscountHandler;
use App\Models\InvoiceDTO;
class ShippingDiscountHandlerTest extends TestCase
{       
    
    public function test_test_calculatediscount_function_of_shippingdiscounthandler_Service_by_using_two_products_in_cart(){
        $shippingDiscountHandler = new ShippingDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($shippingDiscountHandler, 'calculateDiscount', [['Jacket', 'T-shirt'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalShippingDiscount, 10);
    }

    public function test_test_calculatediscount_function_of_shippingdiscounthandler_Service_by_using_one_products_in_cart(){
        $shippingDiscountHandler = new ShippingDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($shippingDiscountHandler, 'calculateDiscount', [['Jacket'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalShippingDiscount, 0);
    }

    public function test_test_calculatediscount_function_of_shippingdiscounthandler_Service_by_using_no_products_in_cart(){
        $shippingDiscountHandler = new ShippingDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($shippingDiscountHandler, 'calculateDiscount', [[], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalShippingDiscount, 0);
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
