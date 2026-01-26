@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-0">React Components Example</h4>
            </div>
        </div>

        <!-- Example 1: Basic Component -->
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-3">Example 1: Basic Component</h5>
                <div
                    data-react-component="ExampleComponent"
                    data-react-props='{"title": "Welcome to React!", "userId": {{ auth()->id() }}}'
                ></div>
            </div>
        </div>

        <!-- Example 2: Data Table -->
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-3">Example 3: Data Table Component</h5>
                <div
                    data-react-component="DataTableComponent"
                    data-react-props='{
                        "apiUrl": "{{ route('subscribers.index') }}",
                        "title": "Subscribers List",
                        "columns": [
                            {"label": "Name", "field": "first_name"},
                            {"label": "Email", "field": "email"},
                            {"label": "Status", "field": "status"}
                        ],
                        "actions": [
                            {
                                "label": "Edit",
                                "icon": "mdi mdi-pencil",
                                "className": "btn-outline-primary"
                            },
                            {
                                "label": "Delete",
                                "icon": "mdi mdi-delete",
                                "className": "btn-outline-danger"
                            }
                        ]
                    }'
                ></div>
            </div>
        </div>

        <!-- Example 4: Translation Example -->
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-3">Example 4: Translation Component</h5>
                <div data-react-component="TranslationExample"></div>
            </div>
        </div>

        <!-- Usage Instructions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="mdi mdi-information-outline me-2"></i>
                            How to Use React Components
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6>Step 1: Create Your Component</h6>
                        <pre><code>// resources/js/components/MyComponent.jsx
import React from 'react';

const MyComponent = ({ title, data }) => {
    return (
        &lt;div&gt;
            &lt;h1&gt;{title}&lt;/h1&gt;
            &lt;p&gt;{data}&lt;/p&gt;
        &lt;/div&gt;
    );
};

export default MyComponent;</code></pre>

                        <h6 class="mt-4">Step 2: Use in Blade Template</h6>
                        <pre><code>&lt;div
    data-react-component="MyComponent"
    data-react-props='{
        "title": "Hello World",
        "data": "Some data here"
    }'
&gt;&lt;/div&gt;</code></pre>

                        <h6 class="mt-4">Features Available:</h6>
                        <ul>
                            <li><strong>React Hooks:</strong> useState, useEffect, useMemo, useCallback, etc.</li>
                            <li><strong>Axios:</strong> HTTP requests to your Laravel API</li>
                            <li><strong>React Hot Toast:</strong> Beautiful notifications</li>
                            <li><strong>Bootstrap 5:</strong> All Bootstrap classes available</li>
                            <li><strong>Material Design Icons:</strong> Use mdi-* classes</li>
                            <li><strong>Lodash:</strong> Utility functions</li>
                        </ul>

                        <h6 class="mt-4">Helper Functions:</h6>
                        <pre><code>import { notifyMe, objToArray, strLimit } from '@/helpers';

// Show notification
notifyMe('Success!', 'success');

// Use helpers
const array = objToArray(object);
const limited = strLimit(longString, 50);</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        pre {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #4154f1;
        }
        code {
            color: #d63384;
        }
    </style>
@endpush

