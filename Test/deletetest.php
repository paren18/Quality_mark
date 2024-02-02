<?php

use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    public function testDeleteProduct()
    {
        include_once 'Goods/Goods.php';

        $dbMock = $this->createMock(PDO::class);

        $goodsMock = $this->getMockBuilder(Goods::class)
            ->setConstructorArgs([$dbMock])
            ->getMock();

        $productId = 6;

        $goodsMock->method('delete')
            ->willReturn(true);


        $result = $goodsMock->delete($productId);


        $this->assertTrue($result);
    }
}
