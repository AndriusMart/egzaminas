<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['book_id', 'user_id'];

    public function getBooks()
    {
        return $this->belongsTo(Book::class,'book_id', 'id');
    }

    public function getUsers()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
