<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
    {
        public $timestamps = false;
        use HasFactory;

        // 
        public function category() {
            return $this->belongsTo(Category::class);
        }

        public function genre() {
            return $this->belongsTo(Genre::class);
        }

        public function country() {
            return $this->belongsTo(Country::class);
        }

        public function movie_genre() {
            return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id');
        }

        public function episodes() {
            return $this->hasMany(Episode::class);
        }
    }
