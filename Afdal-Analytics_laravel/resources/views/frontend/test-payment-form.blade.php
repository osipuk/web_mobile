@extends('layout.userhead')

@section('content')
    <div id="paypal-button-container-P-7VS38442M2480862VMI473JY"></div>
    <script src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}" data-sdk-integration-source="button-factory"></script>
    <script>
        paypal.Buttons({
            style: {
                shape: 'pill',
                color: 'gold',
                layout: 'horizontal',
                label: 'subscribe'
            },
            createSubscription: function(data, actions) {
                return actions.subscription.create({
                    /* Creates the subscription */
                    plan_id: 'P-7VS38442M2480862VMI473JY'
                });
            },
            onApprove: function(data, actions) {
                console.log(data);
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/subscribe-new-plan-paypal') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        orderID: data.orderID,
                        subscriptionID: data.subscriptionID,
                    },
                    success: () => {
                        window.location.replace('{{ url('/dashboard/user-billing') }}');
                    }
                })
                alert(data.subscriptionID); // You can add optional success message for the subscriber here
            }
        }).render('#paypal-button-container-P-7VS38442M2480862VMI473JY'); // Renders the PayPal button
    </script>

@endsection
