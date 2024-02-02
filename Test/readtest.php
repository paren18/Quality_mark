<?php

use PHPUnit\Framework\TestCase;

class ReadTest extends TestCase
{
    public function testReadProducts()
    {
        include_once 'Goods/Goods.php';
        $dbMock = $this->createMock(PDO::class);

        $productMock = $this->getMockBuilder(Goods::class)
            ->setConstructorArgs([$dbMock])
            ->onlyMethods(['read'])
            ->getMock();

        $productMock->expects($this->once())
            ->method('read')
            ->willReturn($this->createMock(PDOStatement::class));

        $productMock->read();
    }
}
