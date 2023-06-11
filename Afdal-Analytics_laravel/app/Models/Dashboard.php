<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','social_account_id', 'date_from', 'date_to', 'company_id', 'page_id'];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
