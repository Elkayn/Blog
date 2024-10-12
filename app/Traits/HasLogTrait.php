<?php
namespace App\Traits;

use App\Events\EndLogEvent;
use App\Events\StartLogEvent;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Log;
use App\Models\Post;

trait HasLogTrait{
    protected static function booted(){
        static::created(function ($object){
            StartLogEvent::dispatch();
            Log::create([
                'name_event' => 'Создание',
                'actual_data' => $object
            ]);
            EndLogEvent::dispatch();
        });

        static::updated(function ($object){
            StartLogEvent::dispatch();
            $oldData = json_encode($object->getOriginal());
            Log::create([
                'name_event' => 'Обновление',
                'old_data' => $oldData,
                'actual_data' => $object,
            ]);
            EndLogEvent::dispatch();
        });

        static::deleted(function ($object){
            StartLogEvent::dispatch();
            Log::create([
                'name_event' => 'Удаление',
                'actual_data' => $object,
            ]);
            EndLogEvent::dispatch();
        });

        static::retrieved(function ($object){
//            StartLogEvent::dispatch();
//            Log::create([
//                'name_event' => 'Извлечение',
//                'actual_data' => $object,
//            ]);
//            EndLogEvent::dispatch();
        });
    }
}
