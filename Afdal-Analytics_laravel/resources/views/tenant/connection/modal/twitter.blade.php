@extends('tenant.connection.modal.whats_next')

@section('name'){{__("Twitter")}}@endsection
@section('message'){{__("Your Twitter account was successfully connected")}}@endsection
@section('dashboard_url'){{ url('dashboard/twitter-overview') }}@endsection
@section('img'){!! asset('assets/image/whats-next-modal/twitter.svg') !!}@endsection
@section('visit_description'){{__("Add Twitter widgets to your custom dashboard")}}@endsection
@section('explore_description'){{__("View all available metrics using a pre-made Twitter Dashboard")}}@endsection
@section('explore'){{__("Explore Twitter")}}@endsection
