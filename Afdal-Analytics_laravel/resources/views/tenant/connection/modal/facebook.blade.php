@extends('tenant.connection.modal.whats_next')

@section('name'){{__("Facebook")}}@endsection
@section('message'){{__("Your Facebook account was successfully connected")}}@endsection
@section('dashboard_url'){{ url('dashboard/facebook-overview') }}@endsection
@section('img'){!! asset('assets/image/whats-next-modal/facebook.svg') !!}@endsection
@section('visit_description'){{__("Add Facebook widgets to your custom dashboard")}}@endsection
@section('explore_description'){{__("View all available metrics using a pre-made Facebook Dashboard")}}@endsection
@section('explore'){{__("Explore Facebook")}}@endsection
