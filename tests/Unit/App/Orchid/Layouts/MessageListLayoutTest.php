<?php

namespace Laravia\Message\Tests\Unit\App\Orchid\Layouts;

use Laravia\Message\App\Orchid\Layouts\MessageListLayout;
use Laravia\Heart\App\Classes\TestCase;

class MessageListLayoutTest extends TestCase
{

    public $class = 'Laravia\Message\App\Orchid\Layouts\MessageListLayout';

    public function testInitClass()
    {
        $this->assertClassExist($this->class);
    }

    public function testColumnsExist()
    {
        $this->assertMethodInClassExists('columns', MessageListLayout::class);
    }
    public function testColumns()
    {
        $this->assertIsArray((new MessageListLayout)->columns());
    }
}
