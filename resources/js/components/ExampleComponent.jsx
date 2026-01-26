import React, { useState, useEffect } from 'react';
import axios from 'axios';
import toast from 'react-hot-toast';

/**
 * Example React Component
 *
 * Usage in Blade:
 * <div
 *   data-react-component="ExampleComponent"
 *   data-react-props='{"title": "Hello World", "userId": 1}'
 * ></div>
 */
const ExampleComponent = ({ title = "Default Title", userId = null }) => {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(false);
    const [count, setCount] = useState(0);

    useEffect(() => {
        // Fetch data on component mount
        fetchData();
    }, []);

    const fetchData = async () => {
        setLoading(true);
        try {
            const response = await axios.get('/api/example-endpoint');
            setData(response.data);
            toast.success('Data loaded successfully!');
        } catch (error) {
            console.error('Error fetching data:', error);
            toast.error('Failed to load data');
        } finally {
            setLoading(false);
        }
    };

    const handleIncrement = () => {
        setCount(prev => prev + 1);
        toast.success(`Count increased to ${count + 1}`);
    };

    return (
        <div className="example-component card shadow-sm p-4">
            <div className="card-body">
                <h2 className="card-title mb-4">
                    <i className="mdi mdi-react me-2"></i>
                    {title}
                </h2>

                {userId && (
                    <div className="alert alert-info mb-3">
                        <i className="mdi mdi-information-outline me-2"></i>
                        User ID: {userId}
                    </div>
                )}

                <div className="row mb-4">
                    <div className="col-md-6">
                        <div className="card bg-primary text-white">
                            <div className="card-body">
                                <h3 className="mb-0">{count}</h3>
                                <p className="mb-0">Counter Value</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6">
                        <button
                            className="btn btn-success w-100 h-100"
                            onClick={handleIncrement}
                        >
                            <i className="mdi mdi-plus-circle me-2"></i>
                            Increment
                        </button>
                    </div>
                </div>

                {loading ? (
                    <div className="text-center py-4">
                        <div className="spinner-border text-primary" role="status">
                            <span className="visually-hidden">Loading...</span>
                        </div>
                        <p className="mt-2">Loading data...</p>
                    </div>
                ) : (
                    <div className="data-section">
                        <h5 className="mb-3">Data Items</h5>
                        {data.length > 0 ? (
                            <ul className="list-group">
                                {data.map((item, index) => (
                                    <li key={index} className="list-group-item">
                                        {item.name || item.title || JSON.stringify(item)}
                                    </li>
                                ))}
                            </ul>
                        ) : (
                            <div className="alert alert-warning">
                                <i className="mdi mdi-alert-outline me-2"></i>
                                No data available
                            </div>
                        )}
                    </div>
                )}

                <div className="mt-4">
                    <button
                        className="btn btn-outline-primary"
                        onClick={fetchData}
                        disabled={loading}
                    >
                        <i className="mdi mdi-refresh me-2"></i>
                        Refresh Data
                    </button>
                </div>
            </div>
        </div>
    );
};

export default ExampleComponent;

