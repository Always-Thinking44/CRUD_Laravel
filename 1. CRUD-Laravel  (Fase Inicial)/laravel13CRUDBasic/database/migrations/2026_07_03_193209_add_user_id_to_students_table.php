<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'image', 'turma_id', 'user_id'];

    public function Turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        // Sempre que uma query for feita, filtra automaticamente pelo usuário logado
        static::addGlobalScope('owner', function (Builder $builder) {
            if (auth()->check()) {
                $builder->where('user_id', auth()->id());
            }
        });

        // Ao criar um novo Student, preenche o user_id automaticamente
        static::creating(function ($student) {
            if (auth()->check()) {
                $student->user_id = auth()->id();
            }
        });
    }
}
