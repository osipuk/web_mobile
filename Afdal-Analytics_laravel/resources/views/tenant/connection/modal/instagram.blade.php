@extends('tenant.connection.modal.whats_next')

@section('name'){{__("Instagram")}}@endsection
@section('message'){{__("Your Instagram account was successfully connected")}}@endsection
@section('dashboard_url'){{ url('dashboard/instagram-overview') }}@endsection
@section('img'){!! asset('assets/image/whats-next-modal/instagram.svg') !!}@endsection
@section('visit_description'){{__("Add Instagram widgets to your custom dashboard")}}@endsection
@section('explore_description'){{__("View all available metrics using a pre-made Instagram Dashboard")}}@endsection
@section('explore'){{__("Explore Instagram")}}@endsection
