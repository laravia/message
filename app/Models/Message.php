<?php

namespace Laravia\Message\App\Models;

use Laravia\Heart\App\Models\Model;
use Orchid\Screen\AsSource;

class Message extends Model
{
    use AsSource;
    protected $fillable = [
        'project',
        'url',
        'from',
        'body',
    ];

}
