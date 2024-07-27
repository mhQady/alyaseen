<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductStockChanged implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message = 'stock-changed';
    public function __construct(protected Product $product)
    {
        $this->message = "مخزون المُنتج {$this->product->name} :رقم ({$this->product->id}) تم تغييره للقيمة {$this->product->current_stock}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('stock-channel'),
        ];
    }

    public function broadcastAs()
    {
        return 'stock-changed';
    }

    public function broadcastWhen(): bool
    {
        return $this->product->current_stock < 5;
    }
}
