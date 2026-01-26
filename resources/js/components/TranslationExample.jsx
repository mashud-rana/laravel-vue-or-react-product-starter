import React, { useState } from 'react';
import { __, trans, trans_choice, getLocale } from '../utils/translate';
import toast from 'react-hot-toast';

/**
 * Translation Example Component
 * Demonstrates how to use Laravel translations in React
 */
const TranslationExample = () => {
    const [count, setCount] = useState(1);
    const locale = getLocale();

    const handleIncrement = () => {
        setCount(count + 1);
        toast.success(__('Count updated successfully!'));
    };

    return (
        <div className="card">
            <div className="card-header bg-primary text-white">
                <h5 className="mb-0">
                    <i className="mdi mdi-translate me-2"></i>
                    {__('Translation Example')}
                </h5>
            </div>
            <div className="card-body">
                {/* Simple Translation */}
                <div className="mb-4">
                    <h6 className="text-primary">{__('Simple Translation')}</h6>
                    <p className="mb-1">
                        <strong>{__('Key')}:</strong> <code>Welcome</code>
                    </p>
                    <p>
                        <strong>{__('Result')}:</strong> {__('Welcome')}
                    </p>
                </div>

                {/* Translation with Replacements */}
                <div className="mb-4">
                    <h6 className="text-primary">{__('Translation with Replacements')}</h6>
                    <p className="mb-1">
                        <strong>{__('Key')}:</strong> <code>Hello :name!</code>
                    </p>
                    <p>
                        <strong>{__('Result')}:</strong> {__('Hello :name!', { name: 'John' })}
                    </p>
                </div>

                {/* Pluralization Example */}
                <div className="mb-4">
                    <h6 className="text-primary">{__('Pluralization')}</h6>
                    <div className="d-flex align-items-center gap-3">
                        <button
                            className="btn btn-sm btn-outline-primary"
                            onClick={() => setCount(Math.max(0, count - 1))}
                        >
                            <i className="mdi mdi-minus"></i>
                        </button>
                        <div className="text-center">
                            <h3 className="mb-0">{count}</h3>
                            <small className="text-muted">
                                {trans_choice('item|items', count)}
                            </small>
                        </div>
                        <button
                            className="btn btn-sm btn-outline-primary"
                            onClick={handleIncrement}
                        >
                            <i className="mdi mdi-plus"></i>
                        </button>
                    </div>
                </div>

                {/* Current Locale */}
                <div className="mb-4">
                    <h6 className="text-primary">{__('Current Locale')}</h6>
                    <span className="badge bg-success">{locale}</span>
                </div>

                {/* Usage Instructions */}
                <div className="alert alert-info">
                    <h6 className="alert-heading">
                        <i className="mdi mdi-information-outline me-2"></i>
                        {__('How to Use')}
                    </h6>
                    <hr />
                    <p className="mb-2"><strong>{__('Import the helper')}:</strong></p>
                    <pre className="bg-light p-2 rounded mb-3">
                        <code>{`import { __, trans, trans_choice } from '@/utils/translate';`}</code>
                    </pre>

                    <p className="mb-2"><strong>{__('Simple translation')}:</strong></p>
                    <pre className="bg-light p-2 rounded mb-3">
                        <code>{`__('Welcome')`}</code>
                    </pre>

                    <p className="mb-2"><strong>{__('With replacements')}:</strong></p>
                    <pre className="bg-light p-2 rounded mb-3">
                        <code>{`__('Hello :name!', { name: 'John' })`}</code>
                    </pre>

                    <p className="mb-2"><strong>{__('Pluralization')}:</strong></p>
                    <pre className="bg-light p-2 rounded mb-0">
                        <code>{`trans_choice('item|items', count)`}</code>
                    </pre>
                </div>

                {/* Supported Translation Keys */}
                <div className="alert alert-secondary">
                    <h6 className="alert-heading">
                        <i className="mdi mdi-information-outline me-2"></i>
                        {__('Supported Keys')}
                    </h6>
                    <p className="mb-0">
                        {__('All Laravel translation keys are available through')} <code>window.translations</code>.
                        {__('Translations are loaded from your Laravel language files automatically')}.
                    </p>
                </div>
            </div>
        </div>
    );
};

export default TranslationExample;

