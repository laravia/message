<?php

namespace Laravia\Message\Tests\Feature\App\Orchid\Screens;

use Laravia\Heart\App\Classes\TestCase;

class MessageScreenFeatureTest extends TestCase
{

    public function test_message_screen_can_be_rendered()
    {
        $this->actAsAdmin();
        $response = $this->get(route('laravia.message.list'));
        $response->assertOk();
    }

}
