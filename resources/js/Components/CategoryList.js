import React, { useEffect, useState } from 'react';
import CategoryService from 'd:/laragon/www/inventory/resources/js/Services/CategoryService';
import Alert from './Alert';
import Button from './Button';

const CategoryList = ({ history }) => {
    const [categories, setCategories] = useState([]);
    const [alert, setAlert] = useState(null);

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
                fetchCategories();
            } catch (error) {
                setAlert({ type: 'error', message: 'Failed to delete category' });
            }
        }
    };

    return (
        <div>
            <h1>Categories</h1>
            <Button onClick={() => history.push('/categories/add')} className="btn-primary">
                Add Category
            </Button>
            {alert && <Alert type={alert.type} message={alert.message} />}
            <table className="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {categories.map((category) => (
                        <tr key={category.id}>
                            <td>{category.name}</td>
                            <td>{category.description}</td>
                            <td>
                                <Button onClick={() => history.push(`/categories/edit/${category.id}`)} className="btn-warning">
                                    Edit
                                </Button>
                                <Button onClick={() => handleDelete(category.id)} className="btn-danger">
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

export default CategoryList;