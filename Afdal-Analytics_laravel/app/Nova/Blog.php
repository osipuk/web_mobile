<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Kraftbit\NovaTinymce5Editor\NovaTinymce5Editor;
use Emilianotisato\NovaTinyMCE\NovaTinyMCE;
use NumaxLab\NovaCKEditor5Classic\CKEditor5Classic;
use Manogi\Tiptap\Tiptap;

class Blog extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Blog::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'seo_url'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Author', 'author_name')
                ->sortable(),

            Text::make('Meta Title', 'meta_title')
                ->hideFromIndex()
                ->sortable(),

            Text::make('Meta Keywords', 'meta_keywords')
                ->hideFromIndex()
                ->sortable(),

            Text::make('Meta Description', 'meta_description')
                ->hideFromIndex()
                ->sortable(),

            Text::make('SEO Url', 'seo_url')
                ->hideFromIndex()
                ->creationRules('unique:blogs,seo_url')
                ->updateRules('unique:blogs,seo_url,{{resourceId}}')
                ->sortable(),

            Date::make('Date', 'date'),

            Tiptap::make('Description')
                ->buttons([
                    'heading', '|',
                    'italic', 'bold', '|',
                    'link', 'code', 'strike', 'underline', 'highlight', '|',
                    'bulletList', 'orderedList', 'br', 'codeBlock', 'blockquote', '|',
                    'horizontalRule', 'hardBreak', '|',
                    'table', '|',
                    'image', '|',
                    'textAlign', '|',
                    'rtl', '|',
                    'history', '|',
                    'editHtml',
                ])
                    ->headingLevels([2, 3, 4])
                ->hideFromIndex()
                ->linkSettings([
                    'withFileUpload' => true,
                ])
                ->sortable(),

            Number::make('H2 font size', 'h2_size')
                ->hideFromIndex()
                ->sortable(),

            Number::make('H3 font size', 'h3_size')
                ->hideFromIndex()
                ->sortable(),

            Number::make('H4 font size', 'h4_size')
                ->hideFromIndex()
                ->sortable(),

            Number::make('Simple text font size', 'text_size')
                ->hideFromIndex()
                ->sortable(),

            Image::make('Image')
                ->disk('public')
                ->creationRules('required')
                ->deletable(false),

            Boolean::make('Show', 'show')
                ->sortable(),

            BelongsTo::make('Category', 'category')
                ->display('name')
                ->rules('required', 'max:255')
                ->nullable(),

            BelongsTo::make('Tag', 'tag', Tag::class)
                ->rules('required', 'max:255')
                ->display('title')
                ->nullable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
