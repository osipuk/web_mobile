@extends('tenant.connection.modal.whats_next')

@section('name'){{__("Facebook Ads")}}@endsection
@section('message'){{__("Your Facebook Ads account was successfully connected")}}@endsection
@section('dashboard_url'){{ url('dashboard/facebook-ads-overview') }}@endsection
@section('img'){!! asset('assets/image/whats-next-modal/facebook.svg') !!}@endsection
@section('visit_description'){{__("Add Facebook Ads widgets to your custom dashboard")}}@endsection
@section('visit_description'){{__("View all available metrics using a pre-made Facebook Ads")}}@endsection
@section('explore_description'){{__("View all available metrics using a pre-made Facebook Ads Dashboard")}}@endsection
@section('explore'){{__("Explore Facebook Ads")}}@endsection
