<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Manogi\Tiptap\Tiptap;
use Yna\NovaSwatches\Swatches;

class Guide extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Guide::class;

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

            Tiptap::make('Description', 'text')
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

            Image::make('File')
                ->disk('public')
                ->creationRules('required')
                ->deletable(false),

            Image::make('Image')
                ->disk('public')
                ->creationRules('required')
                ->deletable(false),

            Text::make('Meta Author', 'author_name')
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
                ->creationRules('unique:guides,seo_url')
                ->updateRules('unique:guides,seo_url,{{resourceId}}')
                ->sortable(),

            Swatches::make('Background', 'background')->colors('basic'),

            Swatches::make('Font color', 'font_color')->colors(['grey','#ffffff', '#000']),

            Boolean::make('Show', 'status')
                ->sortable(),
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
