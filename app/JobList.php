<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class JobList extends Model {
    protected $table = 'job_list';
    protected $fillable = ['name'];
}
