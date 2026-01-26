@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Student Profile with React Component -->
        <div
            data-react-component="StudentDashboard"
            data-react-props='{
                "studentId": {{ $id }},
                "apiUrl": "{{ url('/api') }}"
            }'
        ></div>
    </div>
@endsection

