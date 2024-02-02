<?php

use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function testSearchProducts()
    {
        include_once 'Goods/Goods.php';

        $dbMock = $this->createMock(PDO::class);


        $productMock = $this->getMockBuilder(Goods::class)
            ->setConstructorArgs([$dbMock])
            ->onlyMethods(['search'])
            ->getMock();


        $productMock->expects($this->once())
            ->method('search')
            ->with($this->equalTo('your_search_query'))
            ->willReturn($this->createMock(PDOStatement::class));


        $productMock->search('your_search_query');
    }
}
