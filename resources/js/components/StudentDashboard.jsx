import React, { useState, useEffect } from 'react';
import axios from 'axios';
import toast from 'react-hot-toast';
import { __ } from '../utils/translate';

/**
 * Student Dashboard Component
 * Simple and professional dashboard showing student detailed information
 */
const StudentDashboard = ({ studentId, apiUrl = '/api' }) => {
    const [student, setStudent] = useState(null);
    const [loading, setLoading] = useState(true);
    const [activeTab, setActiveTab] = useState('personal');

    useEffect(() => {
        fetchStudentData();
    }, [studentId]);

    const fetchStudentData = async () => {
        setLoading(true);
        try {
            const studentResponse = await axios.get(`${apiUrl}/students/${studentId}`);
            setStudent(studentResponse.data);
        } catch (error) {
            console.error('Error fetching student data:', error);
            toast.error(__('Failed to load student data'));
            setStudent(null);
        } finally {
            setLoading(false);
        }
    };

    const calculateAge = (dob) => {
        if (!dob) return null;
        const birthDate = new Date(dob);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    };

    const getFullName = () => {
        if (student?.full_name) return student.full_name;
        return `${student?.first_name || ''} ${student?.last_name || ''}`.trim();
    };

    if (loading) {
        return (
            <div className="d-flex justify-content-center align-items-center" style={{ minHeight: '400px' }}>
                <div className="text-center">
                    <div className="spinner-border text-primary mb-3" role="status" style={{ width: '3rem', height: '3rem' }}>
                        <span className="visually-hidden">Loading...</span>
                    </div>
                    <p className="text-muted">{__('Loading student dashboard...')}</p>
                </div>
            </div>
        );
    }

    if (!student) {
        return (
            <div className="alert alert-warning">
                <i className="mdi mdi-alert-outline me-2"></i>
                {__('Student not found')}
            </div>
        );
    }

    return (
        <div className="student-dashboard">
            {/* Profile Header Card */}
            <div className="card shadow-sm mb-4">
                <div className="card-body">
                    <div className="row align-items-center">
                        <div className="col-auto">
                            <div className="position-relative">
                                <img
                                    src={student.avatar_url}
                                    alt={getFullName()}
                                    className="rounded-circle"
                                    style={{ width: '100px', height: '100px', objectFit: 'cover', border: '3px solid #f8f9fa' }}
                                />
                                <span
                                    className={`position-absolute bottom-0 end-0 rounded-circle border border-3 border-white ${student.status === 'active' ? 'bg-success' : 'bg-warning'}`}
                                    style={{ width: '20px', height: '20px' }}
                                    title={student.status}
                                />
                            </div>
                        </div>
                        <div className="col">
                            <h3 className="mb-1 fw-bold">{getFullName()}</h3>
                            <div className="d-flex align-items-center gap-3 text-muted mb-2">
                                <span><i className="mdi mdi-email me-1"></i>{student.email}</span>
                                {student.phone && <span><i className="mdi mdi-phone me-1"></i>{student.phone}</span>}
                            </div>
                            <div className="d-flex gap-2">
                                <span className="badge bg-primary">{student.type}</span>
                                <span className={`badge ${student.status === 'active' ? 'bg-success' : 'bg-warning'}`}>
                                    {student.status}
                                </span>
                                {student.email_verified_at && (
                                    <span className="badge bg-success">
                                        <i className="mdi mdi-check-circle me-1"></i>Email Verified
                                    </span>
                                )}
                            </div>
                        </div>
                        <div className="col-auto">
                            <button
                                className="btn btn-primary"
                                onClick={() => window.location.href = `/students/${student.id}/edit`}
                            >
                                <i className="mdi mdi-pencil me-1"></i>
                                {__('Edit Profile')}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {/* Information Tabs */}
            <div className="card shadow-sm">
                <div className="card-header bg-white">
                    <ul className="nav nav-tabs card-header-tabs" role="tablist">
                        <li className="nav-item">
                            <button
                                className={`nav-link ${activeTab === 'personal' ? 'active' : ''}`}
                                onClick={() => setActiveTab('personal')}
                            >
                                <i className="mdi mdi-account-circle me-1"></i>
                                {__('Personal Information')}
                            </button>
                        </li>
                        <li className="nav-item">
                            <button
                                className={`nav-link ${activeTab === 'address' ? 'active' : ''}`}
                                onClick={() => setActiveTab('address')}
                            >
                                <i className="mdi mdi-map-marker me-1"></i>
                                {__('Address Details')}
                            </button>
                        </li>
                        {(student.user_detail?.medical_license || student.user_detail?.license_type) && (
                            <li className="nav-item">
                                <button
                                    className={`nav-link ${activeTab === 'license' ? 'active' : ''}`}
                                    onClick={() => setActiveTab('license')}
                                >
                                    <i className="mdi mdi-card-account-details me-1"></i>
                                    {__('License Information')}
                                </button>
                            </li>
                        )}
                    </ul>
                </div>
                <div className="card-body p-4">
                    {/* Personal Info Tab */}
                    {activeTab === 'personal' && (
                        <div>
                            <div className="row g-4">
                                <div className="col-md-6">
                                    <div className="mb-3">
                                        <label className="text-muted small mb-1">{__('First Name')}</label>
                                        <div className="fw-medium">{student.first_name}</div>
                                    </div>
                                    <div className="mb-3">
                                        <label className="text-muted small mb-1">{__('Last Name')}</label>
                                        <div className="fw-medium">{student.last_name}</div>
                                    </div>
                                    <div className="mb-3">
                                        <label className="text-muted small mb-1">{__('Email Address')}</label>
                                        <div className="fw-medium">{student.email}</div>
                                    </div>
                                    <div className="mb-3">
                                        <label className="text-muted small mb-1">{__('Phone Number')}</label>
                                        <div className="fw-medium">{student.phone || 'N/A'}</div>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    {student.gender && (
                                        <div className="mb-3">
                                            <label className="text-muted small mb-1">{__('Gender')}</label>
                                            <div className="fw-medium">{student.gender}</div>
                                        </div>
                                    )}
                                    {student.user_detail?.dob && (
                                        <div className="mb-3">
                                            <label className="text-muted small mb-1">{__('Date of Birth')}</label>
                                            <div className="fw-medium">
                                                {new Date(student.user_detail.dob).toLocaleDateString('en-US', {
                                                    year: 'numeric',
                                                    month: 'long',
                                                    day: 'numeric'
                                                })}
                                                <span className="text-muted ms-2">({calculateAge(student.user_detail.dob)} years old)</span>
                                            </div>
                                        </div>
                                    )}
                                    <div className="mb-3">
                                        <label className="text-muted small mb-1">{__('Joined Date')}</label>
                                        <div className="fw-medium">
                                            {new Date(student.created_at).toLocaleDateString('en-US', {
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric'
                                            })}
                                        </div>
                                    </div>
                                    <div className="mb-3">
                                        <label className="text-muted small mb-1">{__('Last Updated')}</label>
                                        <div className="fw-medium">
                                            {new Date(student.updated_at).toLocaleDateString('en-US', {
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric'
                                            })}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {student.user_detail?.about && (
                                <div className="mt-4 pt-4 border-top">
                                    <label className="text-muted small mb-2">{__('About')}</label>
                                    <p className="mb-0">{student.user_detail.about}</p>
                                </div>
                            )}
                        </div>
                    )}

                    {/* Address Tab */}
                    {activeTab === 'address' && (
                        <div>
                            {student.user_detail?.address ? (
                                <div className="row g-4">
                                    <div className="col-md-12">
                                        <div className="mb-3">
                                            <label className="text-muted small mb-1">{__('Street Address')}</label>
                                            <div className="fw-medium">{student.user_detail.address}</div>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        {student.user_detail.city && (
                                            <div className="mb-3">
                                                <label className="text-muted small mb-1">{__('City')}</label>
                                                <div className="fw-medium">{student.user_detail.city}</div>
                                            </div>
                                        )}
                                        {student.user_detail.state && (
                                            <div className="mb-3">
                                                <label className="text-muted small mb-1">{__('State/Province')}</label>
                                                <div className="fw-medium">{student.user_detail.state}</div>
                                            </div>
                                        )}
                                    </div>
                                    <div className="col-md-6">
                                        {student.user_detail.country && (
                                            <div className="mb-3">
                                                <label className="text-muted small mb-1">{__('Country')}</label>
                                                <div className="fw-medium">{student.user_detail.country}</div>
                                            </div>
                                        )}
                                        {student.user_detail.zip_code && (
                                            <div className="mb-3">
                                                <label className="text-muted small mb-1">{__('Postal/Zip Code')}</label>
                                                <div className="fw-medium">{student.user_detail.zip_code}</div>
                                            </div>
                                        )}
                                    </div>
                                    {student.user_detail.billing_address && (
                                        <div className="col-12">
                                            <div className="mb-3">
                                                <label className="text-muted small mb-1">{__('Billing Address')}</label>
                                                <div className="fw-medium">{student.user_detail.billing_address}</div>
                                            </div>
                                        </div>
                                    )}
                                </div>
                            ) : (
                                <div className="alert alert-info mb-0">
                                    <i className="mdi mdi-information-outline me-2"></i>
                                    {__('No address information available')}
                                </div>
                            )}
                        </div>
                    )}

                    {/* License Info Tab */}
                    {activeTab === 'license' && (
                        <div>
                            {(student.user_detail?.medical_license || student.user_detail?.license_type) ? (
                                <div className="row g-4">
                                    {student.user_detail.medical_license && (
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="text-muted small mb-1">{__('Medical License')}</label>
                                                <div className="fw-medium">{student.user_detail.medical_license}</div>
                                            </div>
                                        </div>
                                    )}
                                    {student.user_detail.license_type && (
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="text-muted small mb-1">{__('License Type')}</label>
                                                <div className="fw-medium">{student.user_detail.license_type}</div>
                                            </div>
                                        </div>
                                    )}
                                    {student.user_detail.license_number && (
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="text-muted small mb-1">{__('License Number')}</label>
                                                <div className="fw-medium">{student.user_detail.license_number}</div>
                                            </div>
                                        </div>
                                    )}
                                </div>
                            ) : (
                                <div className="alert alert-info mb-0">
                                    <i className="mdi mdi-information-outline me-2"></i>
                                    {__('No license information available')}
                                </div>
                            )}
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

export default StudentDashboard;

