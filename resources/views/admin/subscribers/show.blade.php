@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Subscriber Profile with React Component -->
        <div
            data-react-component="SubscriberDashboard"
            data-react-props='{
                "subscriberId": {{ $id }},
                "apiUrl": "{{ url('/api') }}"
            }'
        ></div>
    </div>
@endsection

