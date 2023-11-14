<?php

namespace Laravia\Message\Tests\Unit;

use Laravia\Heart\App\Classes\TestCase;
use Laravia\Message\App\Models\Message as ModelsMessage;
use Laravia\Message\App\Message;

class MessageTest extends TestCase
{
    public function testInitClass()
    {
        $this->assertClassExist(Message::class);
    }

}
