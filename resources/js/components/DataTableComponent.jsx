import React, { useState } from 'react';
import axios from 'axios';
import toast from 'react-hot-toast';

/**
 * Data Table Component
 * Generic reusable data table with search, pagination
 */
const DataTableComponent = ({
    apiUrl,
    columns = [],
    title = "Data Table",
    actions = []
}) => {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(false);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [searchTerm, setSearchTerm] = useState('');
    const [perPage, setPerPage] = useState(10);

    const fetchData = async (page = 1, search = '') => {
        setLoading(true);
        try {
            const response = await axios.get(apiUrl, {
                params: {
                    page,
                    per_page: perPage,
                    search,
                }
            });

            setData(response.data.data || response.data);
            setTotalPages(response.data.last_page || 1);
            setCurrentPage(response.data.current_page || page);
        } catch (error) {
            toast.error('Failed to load data');
            console.error(error);
        } finally {
            setLoading(false);
        }
    };

    React.useEffect(() => {
        fetchData(currentPage, searchTerm);
    }, [currentPage, perPage]);

    const handleSearch = (e) => {
        e.preventDefault();
        setCurrentPage(1);
        fetchData(1, searchTerm);
    };

    const handleAction = async (action, item) => {
        try {
            await action.handler(item);
            toast.success(action.successMessage || 'Action completed');
            fetchData(currentPage, searchTerm);
        } catch (error) {
            toast.error(action.errorMessage || 'Action failed');
            console.error(error);
        }
    };

    return (
        <div className="data-table-component card">
            <div className="card-header bg-white">
                <div className="row align-items-center">
                    <div className="col-md-6">
                        <h5 className="mb-0">{title}</h5>
                    </div>
                    <div className="col-md-6">
                        <form onSubmit={handleSearch} className="d-flex">
                            <input
                                type="text"
                                className="form-control me-2"
                                placeholder="Search..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                            <button type="submit" className="btn btn-primary">
                                <i className="mdi mdi-magnify"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div className="card-body p-0">
                {loading ? (
                    <div className="text-center py-5">
                        <div className="spinner-border text-primary" role="status">
                            <span className="visually-hidden">Loading...</span>
                        </div>
                    </div>
                ) : (
                    <>
                        <div className="table-responsive">
                            <table className="table table-hover mb-0">
                                <thead className="table-light">
                                    <tr>
                                        {columns.map((col, index) => (
                                            <th key={index}>{col.label}</th>
                                        ))}
                                        {actions.length > 0 && <th>Actions</th>}
                                    </tr>
                                </thead>
                                <tbody>
                                    {data.length > 0 ? (
                                        data.map((item, rowIndex) => (
                                            <tr key={rowIndex}>
                                                {columns.map((col, colIndex) => (
                                                    <td key={colIndex}>
                                                        {col.render
                                                            ? col.render(item[col.field], item)
                                                            : item[col.field]
                                                        }
                                                    </td>
                                                ))}
                                                {actions.length > 0 && (
                                                    <td>
                                                        <div className="btn-group">
                                                            {actions.map((action, actionIndex) => (
                                                                <button
                                                                    key={actionIndex}
                                                                    className={`btn btn-sm ${action.className || 'btn-outline-primary'}`}
                                                                    onClick={() => handleAction(action, item)}
                                                                    title={action.label}
                                                                >
                                                                    <i className={action.icon}></i>
                                                                </button>
                                                            ))}
                                                        </div>
                                                    </td>
                                                )}
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan={columns.length + (actions.length > 0 ? 1 : 0)} className="text-center py-4">
                                                <i className="mdi mdi-information-outline me-2"></i>
                                                No data available
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>

                        {/* Pagination */}
                        {totalPages > 1 && (
                            <div className="card-footer bg-white">
                                <div className="row align-items-center">
                                    <div className="col-md-6">
                                        <span className="text-muted">
                                            Page {currentPage} of {totalPages}
                                        </span>
                                    </div>
                                    <div className="col-md-6">
                                        <nav aria-label="Page navigation">
                                            <ul className="pagination justify-content-end mb-0">
                                                <li className={`page-item ${currentPage === 1 ? 'disabled' : ''}`}>
                                                    <button
                                                        className="page-link"
                                                        onClick={() => setCurrentPage(currentPage - 1)}
                                                        disabled={currentPage === 1}
                                                    >
                                                        Previous
                                                    </button>
                                                </li>
                                                {[...Array(totalPages)].map((_, index) => (
                                                    <li
                                                        key={index}
                                                        className={`page-item ${currentPage === index + 1 ? 'active' : ''}`}
                                                    >
                                                        <button
                                                            className="page-link"
                                                            onClick={() => setCurrentPage(index + 1)}
                                                        >
                                                            {index + 1}
                                                        </button>
                                                    </li>
                                                ))}
                                                <li className={`page-item ${currentPage === totalPages ? 'disabled' : ''}`}>
                                                    <button
                                                        className="page-link"
                                                        onClick={() => setCurrentPage(currentPage + 1)}
                                                        disabled={currentPage === totalPages}
                                                    >
                                                        Next
                                                    </button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        )}
                    </>
                )}
            </div>
        </div>
    );
};

export default DataTableComponent;

