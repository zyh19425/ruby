<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\OrderShipped' => [
            'App\Listeners\SendShipmentNotification',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('event.name', function ($foo, $bar) {
            //
        });

        Event::listen('event.*', function ($eventName, array $data) {
            //
        });
    }

    /**
     * 确定是否应自动发现事件和侦听器。
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }

    /**
     * 获取应该用于发现事件的监听器的目录。
     *
     * @return array
     */
    protected function discoverEventsWithin()
    {
        return [
            $this->app->path('Listeners'),
        ];
    }

    /**
     * 被注册的订阅者类
     *
     * @var array
     */
    protected $subscribe = [
        // 'App\Listeners\UserEventSubscriber',
    ];
}
