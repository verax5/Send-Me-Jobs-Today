<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    protected $fillable = ['user_id', 'url', 'title', 'postcode', 'logo', 'snippet', 'age', 'age_days', 'location', 'salary', 'company', 'send_on'];
}
