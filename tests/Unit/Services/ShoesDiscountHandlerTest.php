<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\DiscountChainOfResponsibility\ShoesDiscountHandler;
use App\Models\InvoiceDTO;
class ShoesDiscountHandlerTest extends TestCase
{       
    
    public function test_test_calculatediscount_function_of_shoesdiscounthandler_Service_by_using_two_shoes_in_cart(){
        $shoesDiscountHandler = new ShoesDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($shoesDiscountHandler, 'calculateDiscount', [['Shoes', 'Shoes', 'Jacket'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalShoesDiscount, 15.998);
    }

    public function test_test_calculatediscount_function_of_shoesdiscounthandler_Service_by_using_one_shoes_in_cart(){
        $shoesDiscountHandler = new ShoesDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($shoesDiscountHandler, 'calculateDiscount', [['Shoes'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalShoesDiscount, 7.999);
    }

    public function test_test_calculatediscount_function_of_shoesdiscounthandler_Service_by_using_no_shoes_in_cart(){
        $shoesDiscountHandler = new ShoesDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($shoesDiscountHandler, 'calculateDiscount', [['Jacket'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalShoesDiscount, 0);
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
