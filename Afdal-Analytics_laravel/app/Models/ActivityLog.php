<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'text', 'user', 'date', 'price', 'company_id', 'user_id', 'viewed'];

    protected $appends = ['message'];

    public function getMessageAttribute()
    {
        $message = null;
        $new_text = '';
        $text_array = explode( ' ', $this->text );
        foreach ($text_array as $item){
            $new_text = $new_text . ' ' . __($item);
        }
        switch ($this->type) {
            case 'add_connection':
                $message =  __('Add new connection') . ' ' . $new_text . ' ' . __('to the company');
                break;
            case 'remove_connection':
                $message = __('Remove connection') . ' ' . $new_text . ' ' . __('from company');
                break;
            case 'add_member':
                $message = __('Send invite to') . ' ' . $this->text;
                break;
            case 'remove_member':
                $message = __('Remove member') . ' ' . $this->text . ' ' . __('from company');
                break;
            case 'register':
                $message = __('Accepted an invitation to the company');
                break;
            case 'subscribe':
                $message = __('Subscribe to') . ' ' . __($this->text);
                break;
            case 'change_plan':
                $message = __('Change plan to') . ' ' .  __($this->text);
                break;
            case 'cancel_subscription':
                $message = __('Cancel  subscription') . ' ' .  __($this->text);
                break;
            case 'social_account_get_data_with_error':
                $message = __('Unable to get social account data ') . ' ' .  __($this->text);
                break;
        }
        return $message;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

}
