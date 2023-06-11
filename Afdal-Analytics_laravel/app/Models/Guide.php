<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'file',
        'image',
        'status',
        'seo_url',
        'background',
        'font_color',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'author_name'
    ];

    public array $open_tags = ['<div', '<p', '<ul', '<ol', '<strong'];
    public array $close_tags = ['</div>', '</p>', '</ul>', '</ol>', '</strong>'];
    public string $text_alignment = 'text-align: start';

    function guideTextFormat(): Guide
    {
        $string = Str::limit($this->text, 100);
        $string = str_replace($this->text_alignment, '', $string);
        for($i = 0; $i < count($this->open_tags); $i++){
            if(substr_count($string,$this->open_tags[$i]) !== substr_count($string,$this->close_tags[$i])){
                $this->text = $string . $this->close_tags[$i];
            }
        }
        return $this;
    }
}
