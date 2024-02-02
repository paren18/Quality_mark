<?php

use PHPUnit\Framework\TestCase;

class UpdateTest extends TestCase
{
    public function testUpdateProduct()
    {    include_once 'Goods/Goods.php';
        $dbMock = $this->createMock(PDO::class);

        $product = $this->getMockBuilder(Goods::class)
            ->setConstructorArgs([$dbMock])
            ->onlyMethods(['update'])
            ->getMock();

        $data = (object) [
            'name' => 'Продукт',
            'inn' => '0987654321',
            'barcode' => '1234567890',
            'description' => 'Обновление.',
            'price' => 29,
            'category_id' => 2,
        ];

        $product->expects($this->once())
            ->method('update')
            ->willReturn(true);

        $result = $product->update($data);

        $this->assertTrue($result);
    }
}
