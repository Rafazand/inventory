import React, { useState, useEffect } from 'react';
import Alert from './Alert';
import Button from './Button';

const CategoryForm = ({ history, match }) => {
    const [name, setName] = useState('');
    const [description, setDescription] = useState('');
    const [alert, setAlert] = useState(null);
    const isEdit = match.path.includes('edit');

    useEffect(() => {
        if (isEdit) {
            fetchCategory();
        }
    }, [isEdit, match.params.id]);

    const fetchCategory = async () => {
        try {
            const response = await CategoryService.getById(match.params.id);
            setName(response.data.name);
            setDescription(response.data.description);
        } catch (error) {
            setAlert({ type: 'error', message: 'Failed to fetch category' });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const categoryData = { name, description };

        try {
            if (isEdit) {
                await CategoryService.update(match.params.id, categoryData);
                setAlert({ type: 'success', message: 'Category updated successfully' });
            } else {
                await CategoryService.create(categoryData);
                setAlert({ type: 'success', message: 'Category created successfully' });
            }
            history.push('/categories');
        } catch (error) {
            setAlert({ type: 'error', message: 'Failed to submit category' });
        }
    };

    return (
        <div>
            <h1>{isEdit ? 'Edit Category' : 'Add Category'}</h1>
            <Button onClick={() => history.push('/categories')} className="btn-secondary">
                Back
            </Button>
            {alert && <Alert type={alert.type} message={alert.message} />}
            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label htmlFor="name" className="form-label">Name</label>
                    <input
                        type="text"
                        className="form-control"
                        id="name"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                        required
                    />
                </div>
                <div className="mb-3">
                    <label htmlFor="description" className="form-label">Description</label>
                    <textarea
                        className="form-control"
                        id="description"
                        value={description}
                        onChange={(e) => setDescription(e.target.value)}
                        rows="3"
                    />
                </div>
                <Button type="submit" className="btn-primary">
                    {isEdit ? 'Update' : 'Submit'}
                </Button>
            </form>
        </div>
    );
};

export default CategoryForm;