<?php

namespace App\Console\Commands;

use App\Events\Post\PostStoreEvent;
use App\Exceptions\MyException;
use App\LoggerFormatters\PostFormatter;
use App\Mail\Post\SendNotifyMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\TestFixture\func;
use function Webmozart\Assert\Tests\StaticAnalysis\throws;

class Go extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //syncWithoutDetaching
        //detach
        //sync
        //toggle
        //updateExistingPivot
        //attach

//        Category::create([
//            'title' => 'Tutu',
//            'description' => 'Bubu',
//        ]);


//            $categories = DB::select('Select * from categories where id = :id', ['id' => 3]);
//            $categoriesInsert = DB::insert('insert into categories (title, description) VALUES (:title, :description)', ['title' => 'tolko', 'description' => 'tolko']);
//            DB::update('update categories set title = :title, description = :description where id = :id', ['id' => 26, 'title' => 'тайтл', 'description' => 'описание']);
//            DB::delete('delete from categories where id = 23');

//        DB::transaction(function () {
//            DB::table('categories')->insert(['title' => 'черт', 'description' => 'знает']);
//            DB::table('posts')->update(['category_id' => 15]);
//        });
//        dd(DB::table('categories')->where('id', '=', 1)->get());

//var_dump($categories);
//        Log::channel('post')->info('Created post', [$post]);

//        $col = collect([1,2,3,4]);
//        var_dump($col->sum());
        $post = Post::with('profile')->where('id',33)->get();
//        Mail::to('i.aynetdinov@mail.ru')->send(new SendNotifyMail());
        dd($post);
    }
}

