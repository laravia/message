<?php

namespace Laravia\Message\Tests\Unit\App;

use Laravia\Message\App\Models\Message;
use Laravia\Heart\App\Classes\TestCase;

class MessageModelTest extends TestCase
{
    public function testInitClass()
    {
        $this->assertClassExist(Message::class);
    }

    public function testCreateMessage()
    {
        $from = $this->faker->email;
        $body = $this->faker->text;
        $url = $this->faker->url;
        $project = $this->faker->name;

        Message::create([
            'from' => $from,
            'body' => $body,
            'url' => $url,
            'project' => $project,
        ]);

        $this->assertDatabaseHas('messages', [
            'from' => $from,
            'body' => $body,
            'url' => $url,
            'project' => $project,
        ]);
    }
}
