<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Console\Scheduling\Schedule;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;
    use Prunable;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public $plunabeChunkSize = 100;
    public function prunable() {
        return static::whereDate('created_at', '<', now()->subDays(30));
    }
    protected function schedule(Schedule $schedule) {
        $schedule->command('model:prune')->yearly();
        }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $fillable = ['name', 'file_name', 'category_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
