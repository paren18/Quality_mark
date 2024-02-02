<?php
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testCreateProduct()
    {
        include_once 'Goods/Goods.php';
        $dbMock = $this->createMock(PDO::class);

        $product = $this->getMockBuilder(Goods::class)
            ->setConstructorArgs([$dbMock])
            ->onlyMethods(['create'])
            ->getMock();

        $data = (object) [
            'name' => 'Продукт',
            'inn' => '0987654321',
            'barcode' => '1234567890',
            'description' => 'Новый.',
            'price' => 29,
            'category_id' => 2,
        ];

        $product->expects($this->once())
            ->method('create')
            ->willReturn(true);

        $result = $product->create($data);

        $this->assertTrue($result);
    }
}
