<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Turma extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'user_id'
    ];

    public function alunos()
    {
        return $this->hasMany(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('owner', function (Builder $builder) {
            if (auth()->check()) {
                $builder->where('user_id', auth()->id());
            }
        });

        static::creating(function ($turma) {
            if (auth()->check()) {
                $turma->user_id = auth()->id();
            }
        });
    }
}
