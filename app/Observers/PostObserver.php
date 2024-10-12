<?php

namespace App\Observers;

use App\Events\EndLogEvent;
use App\Events\StartLogEvent;
use App\LoggerFormatters\PostFormatter;
//use App\Models\Log;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    private string $entity = 'post';

    public function created(Post $post): void
    {
        StartLogEvent::dispatch();
//        Log::create([
//            'name_event' => 'Создание',
//            'actual_data' => $post
//        ]);
        Log::build([
            'driver' => 'single',
            'path' => storage_path("logs/$this->entity.log"),
            'tap' => [PostFormatter::class],
        ])->info('Created post', [$post]);
        EndLogEvent::dispatch();
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        StartLogEvent::dispatch();
        $oldData = json_encode($post->getOriginal());
//        Log::create([
//            'name_event' => 'Обновление',
//            'old_data' => $oldData,
//            'actual_data' => $post,
//        ]);
        Log::build([
            'driver' => 'single',
            'path' => storage_path("logs/$this->entity.log"),
            'tap' => [PostFormatter::class],
        ])->info('Updated post', ['old_data' => $oldData, 'actual_data' => $post]);
        EndLogEvent::dispatch();
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        StartLogEvent::dispatch();
//        Log::create([
//            'name_event' => 'Удаление',
//            'actual_data' => $post,
//        ]);
        Log::build([
            'driver' => 'single',
            'path' => storage_path("logs/$this->entity.log"),
            'tap' => [PostFormatter::class],
        ])->info('Deleted post', [$post]);
        EndLogEvent::dispatch();
    }

    public function retrieved(Post $post): void
    {
        StartLogEvent::dispatch();
//        Log::create([
//            'name_event' => 'Извлечение',
//            'actual_data' => $post,
//        ]);
        Log::build([
            'driver' => 'single',
            'path' => storage_path("logs/$this->entity.log"),
            'tap' => [PostFormatter::class],
        ])->info('Read post', [$post]);
        EndLogEvent::dispatch();
    }
    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
