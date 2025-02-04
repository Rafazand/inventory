import React, { useEffect, useState } from 'react';
import CategoryService from 'd:/laragon/www/inventory/resources/js/Services/CategoryService';
import Alert from './Alert';
import Button from './Button';
import { useHistory } from 'react-router-dom';

const CategoryIndex = () => {
    const [categories, setCategories] = useState([]);
    const [alert, setAlert] = useState(null);
    const history = useHistory();

    useEffect(() => {
        fetchCategories();
    }, []);

    const fetchCategories = async () => {
        try {
            const response = await CategoryService.getAll();
            setCategories(response.data);
        } catch (error) {
            setAlert({ type: 'error', message: 'Failed to fetch categories' });
        }
    };

    const handleDelete = async (id) => {
        if (window.confirm('Are you sure?')) {
            try {
                await CategoryService.delete(id);
                setAlert({ type: 'success', message: 'Category deleted successfully' });
                fetchCategories(); // Refresh the list after deletion
            } catch (error) {
                setAlert({ type: 'error', message: 'Failed to delete category' });
            }
        }
    };

    return (
        <div>
            <div className="d-flex justify-content-between align-items-center mb-4 fade-in">
                <h1>Categories</h1>
                <Button onClick={() => history.push('/categories/create')} className="btn-primary btn-pulse">
                    Add Category
                </Button>
            </div>

            {alert && <Alert type={alert.type} message={alert.message} />}

            <table className="table table-bordered table-hover">
                <thead>
                    <tr className="fade-in">
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {categories.map((category) => (
                        <tr key={category.id} className="fade-in hover-effect">
                            <td>{category.name}</td>
                            <td>{category.description}</td>
                            <td>
                                <Button
                                    onClick={() => history.push(`/categories/edit/${category.id}`)}
                                    className="btn-warning btn-sm btn-pulse"
                                >
                                    Edit
                                </Button>
                                <Button
                                    onClick={() => handleDelete(category.id)}
                                    className="btn-danger btn-sm btn-pulse"
                                >
                                    Delete
                                </Button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default CategoryIndex;