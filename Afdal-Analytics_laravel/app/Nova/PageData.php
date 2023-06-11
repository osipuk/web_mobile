<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class PageData extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PageData::class;

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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Number::make('Page Engaged Users')
                ->sortable(),

            Number::make('Page Impressions Paid')
                ->sortable(),

            Number::make('Page Impressions Organic')
                ->sortable(),

            Number::make('Page Fans')
                ->sortable(),

//            Date::make('Date')
//                ->sortable(),

            Number::make('Total Day Online')
                ->sortable(),

            Number::make('Top Hour Online')
                ->sortable(),

            Number::make('Total Hour Online')
                ->sortable(),

            Number::make('Page Reach')
                ->sortable(),

            Number::make('Page Views')
                ->sortable(),

            Number::make('Page Id')
                ->sortable(),

            Number::make('Page impressions Unique')
                ->sortable(),

            Number::make('Page impressions')
                ->sortable(),

            Number::make('Page Impressions Paid Unique')
                ->sortable(),

            Number::make('Page Impressions Organic Unique')
                ->sortable(),

            Number::make('Page Impressions Viral Unique')
                ->sortable(),

            Number::make('Page Impressions Nonviral Unique')
                ->sortable(),

            Number::make('Page Posts Impressions Unique')
                ->sortable(),

            Number::make('Page Posts Impressions Paid Unique')
                ->sortable(),

            Number::make('Page Posts Impressions Organic Unique')
                ->sortable(),

            Number::make('Page Posts Impressions Viral Unique')
                ->sortable(),

            Number::make('Page Posts Impressions Nonviral Unique')
                ->sortable(),

            Number::make('Post Impressions Fan Unique')
                ->sortable(),

//            Number::make('Page Cta Clicks Logged In Total', 'page_cta_clicks_logged_in_total')
//                ->sortable(),

            Number::make('Page Post Engagements')
                ->sortable(),

            Number::make('Page Cta Clicks Logged In By City Unique')
                ->sortable(),

            Number::make('Page Call Phone Clicks Logged In By City Unique')
                ->sortable(),

            Number::make('Page Get Directions Clicks Logged In By City Unique')
                ->sortable(),

            Number::make('Page Website Clicks Logged In By City Unique')
                ->sortable(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
