import React, { useState } from 'react';
import axios from 'axios';
import toast from 'react-hot-toast';

/**
 * Form Component with Laravel Integration
 * Shows how to submit forms to Laravel backend
 */
const FormComponent = ({ apiUrl, redirectUrl, csrfToken }) => {
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        message: ''
    });
    const [errors, setErrors] = useState({});
    const [loading, setLoading] = useState(false);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));
        // Clear error for this field
        if (errors[name]) {
            setErrors(prev => ({
                ...prev,
                [name]: undefined
            }));
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setErrors({});

        try {
            const response = await axios.post(apiUrl, formData, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            toast.success(response.data.message || 'Form submitted successfully!');

            // Reset form
            setFormData({
                name: '',
                email: '',
                phone: '',
                message: ''
            });

            // Redirect if URL provided
            if (redirectUrl) {
                setTimeout(() => {
                    window.location.href = redirectUrl;
                }, 1500);
            }

        } catch (error) {
            if (error.response) {
                // Validation errors
                if (error.response.status === 422) {
                    setErrors(error.response.data.errors || {});
                    toast.error('Please fix the validation errors');
                } else {
                    toast.error(error.response.data.message || 'Something went wrong!');
                }
            } else {
                toast.error('Network error. Please try again.');
            }
            console.error('Form submission error:', error);
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="card shadow-sm">
            <div className="card-header bg-primary text-white">
                <h5 className="mb-0">
                    <i className="mdi mdi-file-document-edit me-2"></i>
                    Contact Form
                </h5>
            </div>
            <div className="card-body">
                <form onSubmit={handleSubmit}>
                    <div className="row">
                        <div className="col-md-6 mb-3">
                            <label htmlFor="name" className="form-label">
                                Name <span className="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                className={`form-control ${errors.name ? 'is-invalid' : ''}`}
                                id="name"
                                name="name"
                                value={formData.name}
                                onChange={handleChange}
                                placeholder="Enter your name"
                                required
                            />
                            {errors.name && (
                                <div className="invalid-feedback">
                                    {errors.name[0]}
                                </div>
                            )}
                        </div>

                        <div className="col-md-6 mb-3">
                            <label htmlFor="email" className="form-label">
                                Email <span className="text-danger">*</span>
                            </label>
                            <input
                                type="email"
                                className={`form-control ${errors.email ? 'is-invalid' : ''}`}
                                id="email"
                                name="email"
                                value={formData.email}
                                onChange={handleChange}
                                placeholder="Enter your email"
                                required
                            />
                            {errors.email && (
                                <div className="invalid-feedback">
                                    {errors.email[0]}
                                </div>
                            )}
                        </div>

                        <div className="col-md-12 mb-3">
                            <label htmlFor="phone" className="form-label">
                                Phone
                            </label>
                            <input
                                type="tel"
                                className={`form-control ${errors.phone ? 'is-invalid' : ''}`}
                                id="phone"
                                name="phone"
                                value={formData.phone}
                                onChange={handleChange}
                                placeholder="Enter your phone number"
                            />
                            {errors.phone && (
                                <div className="invalid-feedback">
                                    {errors.phone[0]}
                                </div>
                            )}
                        </div>

                        <div className="col-md-12 mb-3">
                            <label htmlFor="message" className="form-label">
                                Message <span className="text-danger">*</span>
                            </label>
                            <textarea
                                className={`form-control ${errors.message ? 'is-invalid' : ''}`}
                                id="message"
                                name="message"
                                value={formData.message}
                                onChange={handleChange}
                                placeholder="Enter your message"
                                rows="4"
                                required
                            ></textarea>
                            {errors.message && (
                                <div className="invalid-feedback">
                                    {errors.message[0]}
                                </div>
                            )}
                        </div>
                    </div>

                    <div className="d-flex justify-content-end gap-2">
                        <button
                            type="button"
                            className="btn btn-light"
                            onClick={() => setFormData({
                                name: '',
                                email: '',
                                phone: '',
                                message: ''
                            })}
                            disabled={loading}
                        >
                            <i className="mdi mdi-refresh me-1"></i>
                            Reset
                        </button>
                        <button
                            type="submit"
                            className="btn btn-primary"
                            disabled={loading}
                        >
                            {loading ? (
                                <>
                                    <span className="spinner-border spinner-border-sm me-2"></span>
                                    Submitting...
                                </>
                            ) : (
                                <>
                                    <i className="mdi mdi-send me-1"></i>
                                    Submit
                                </>
                            )}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default FormComponent;

