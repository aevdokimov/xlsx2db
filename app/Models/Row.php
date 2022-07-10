<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use BroadcastsEvents, HasFactory;

    protected $fillable = ['id', 'name', 'date'];

    protected $table = 'rows';

    public $timestamps = false;
    public $incrementing = false;

    /**
     * Get the channels that model events should broadcast on.
     *
     * @param  string  $event
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn($event)
    {
        return new Channel('rows');
    }
}
