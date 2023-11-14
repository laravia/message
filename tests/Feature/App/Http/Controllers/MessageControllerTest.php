<?php

namespace Laravia\Message\Tests\Feature\App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Laravia\Heart\App\Classes\TestCase as ClassesTestCase;
use Laravia\Message\App\Http\Controllers\MessageController;
use Laravia\Message\App\Models\Message;

class MessageControllerTest extends ClassesTestCase
{
    public function testMessageControllerExists()
    {
        $this->assertClassExist(MessageController::class);
    }
    public function testStore()
    {
        $data = [
            'from' => $this->faker->email,
            'body' => $this->faker->sentence
        ];

        putenv('MAIL_DEFAULT_RECIPIENT=test@test.com');

        Mail::fake();

        $response = $this->post(route('laravia.message::store'), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('messages', $data);
        Message::truncate();
    }

    public function testStoreWithHoneypotFailed()
    {
        $data = [
            'from' => $this->faker->email,
            'body' => $this->faker->sentence,
            'honeypot' => $this->faker->name
        ];

        putenv('MAIL_DEFAULT_RECIPIENT=test@test.com');

        Mail::fake();

        $response = $this->post(route('laravia.message::store'), $data);
        $response->assertSessionHasErrors('honeypot');
    }
}
