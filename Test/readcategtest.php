<?php
use PHPUnit\Framework\TestCase;

class ReadCategTest extends TestCase
{
    public function testReadAllWithCount()
    {
        include_once 'Categories/Categories.php';
        $dbMock = $this->createMock(PDO::class);

        $category = $this->getMockBuilder(Categories::class)
            ->setConstructorArgs([$dbMock])
            ->onlyMethods(['readAllWithCount'])
            ->getMock();

        $stmtMock = $this->createMock(PDOStatement::class);

        $category->expects($this->once())
            ->method('readAllWithCount')
            ->willReturn($stmtMock);

        $result = $category->readAllWithCount();

        $this->assertInstanceOf(PDOStatement::class, $result);
    }
}
