import "./bootstrap";
import "../css/app.css";
import React from 'react';
import { createRoot } from 'react-dom/client';
import toast, { Toaster } from 'react-hot-toast';

// Make React and toast available globally
window.React = React;
window.toast = toast;

// Auto-mount React components
document.addEventListener('DOMContentLoaded', () => {
    // Find all elements with data-react-component attribute
    const components = document.querySelectorAll('[data-react-component]');

    components.forEach((element) => {
        const componentName = element.getAttribute('data-react-component');
        const props = JSON.parse(element.getAttribute('data-react-props') || '{}');

        // Import and mount component dynamically
        import(`./components/${componentName}.jsx`)
            .then((module) => {
                const Component = module.default;
                const root = createRoot(element);
                root.render(
                    <>
                        <Component {...props} />
                        <Toaster position="top-right" />
                    </>
                );
            })
            .catch((error) => {
                console.error(`Failed to load component: ${componentName}`, error);
            });
    });
});

// Export helpers for global use
export * from './helpers';

