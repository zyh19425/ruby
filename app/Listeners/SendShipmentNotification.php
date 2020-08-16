<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendShipmentNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        //
    }

    /**
     * 任务将被发送到的连接的名称
     *
     * @var string|null
     */
    public $connection = 'sqs';

    /**
     * 任务将被发送到的队列的名称
     *
     * @var string|null
     */
    public $queue = 'listeners';

    /**
     * 任务被处理的延迟时间（秒）
     *
     * @var int
     */
    public $delay = 60;

    /**
     * 确定监听器是否应加入队列
     *
     * @param  \App\Events\OrderPlaced  $event
     * @return bool
     */
    public function shouldQueue(OrderPlaced $event)
    {
        return $event->order->subtotal >= 5000;
    }

    /**
     * 处理任务的失败
     *
     * @param  \App\Events\OrderShipped  $event
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(OrderShipped $event, $exception)
    {
        //
    }
}
