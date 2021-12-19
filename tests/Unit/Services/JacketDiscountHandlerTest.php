<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\DiscountChainOfResponsibility\JacketDiscountHandler;
use App\Models\InvoiceDTO;
class JacketDiscountHandlerTest extends TestCase
{       
    public function test_test_calculatediscount_function_of_jacketdiscounthandler_Service_by_using_four_tops_and_two_jackets_in_cart(){
        $jacketDiscountHandler = new JacketDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($jacketDiscountHandler, 'calculateDiscount', [['Jacket', 'Jacket', 'T-shirt','Blouse','T-shirt', 'T-shirt'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalJacketDiscount, 199.99);
    }

    public function test_test_calculatediscount_function_of_jacketdiscounthandler_Service_by_using_two_tops_and_two_jackets_in_cart(){
        $jacketDiscountHandler = new JacketDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($jacketDiscountHandler, 'calculateDiscount', [['Jacket', 'Jacket', 'T-shirt','Blouse'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalJacketDiscount, 99.995);
    }

    public function test_test_calculatediscount_function_of_jacketdiscounthandler_Service_by_using_one_jacket_and_two_tops_in_cart(){
        $jacketDiscountHandler = new JacketDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($jacketDiscountHandler, 'calculateDiscount', [['Jacket', 'T-shirt','Blouse'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalJacketDiscount, 99.995);
    }

    public function test_test_calculatediscount_function_of_jacketdiscounthandler_Service_by_using_no_jacket_in_cart(){
        $jacketDiscountHandler = new JacketDiscountHandler();
        $invoiceDTO = new InvoiceDTO();
        $res = $this->callMethod($jacketDiscountHandler, 'calculateDiscount', [['Shoes', 'T-shirt'], $invoiceDTO]);        
        $this->assertEquals($invoiceDTO->totalJacketDiscount, 0);
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
