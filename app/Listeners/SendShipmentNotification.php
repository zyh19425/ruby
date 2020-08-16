<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendShipmentNotification implements ShouldQueue
{
    public $to;
    public $subject;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->to = '510573690@qq.com';
        $this->subject = 'test';
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        $to = $this->to;
        $subject = $this->subject;
        Mail::send('emails.ship', ['content' => $event], 
            function($event) use ($to, $subject){
            $event->to($to)->subject($subject);
        });
    }

    /**
     * 任务将被发送到的连接的名称
     *
     * @var string|null
     */
    // public $connection = 'sqs';

    /**
     * 任务将被发送到的队列的名称
     *
     * @var string|null
     */
    // public $queue = 'listeners';

    /**
     * 任务被处理的延迟时间（秒）
     *
     * @var int
     */
    // public $delay = 60;

    /**
     * 确定监听器是否应加入队列
     *
     * @param  \App\Events\OrderShipped  $event
     * @return bool
     */
    public function shouldQueue(OrderShipped $event)
    {
        return $event->order->name >= 5000;
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
        $order_id = $event->order->id;
        Log::warning($order_id.' failed.');
    }
}
