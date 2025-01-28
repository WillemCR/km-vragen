<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'pillar_id',
        'category_id',
        'sector_id',
        'is_active',
        'has_custom_answer',
    ];
    // In Question model
    public function pillar()
    {
        return $this->belongsTo(Pillar::class);
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
    // Relatie naar antwoorden
    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('percentage', 'asc');
    }
    // In your Question model
    protected $appends = ['pillar_name'];

    public function getPillarNameAttribute()
    {
        return $this->pillar->pillar_name ?? '';
    }
    public function getDefaultAnswers()
    {
        return $this->answers()->where('is_default', true)->take(10)->get()->map(function($answer) {
            return [
                'text' => $answer->text,
                'percentage' => $answer->percentage,
            ];
        })->toArray();
    }
}
