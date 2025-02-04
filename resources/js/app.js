import './bootstrap';
import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import CategoriesIndex from './pages/CategoriesIndex';
import CategoryForm from 'js/components/CategoryForm';
import AddCategoryPage from './pages/AddCategoryPage';
import EditCategoryPage from './pages/EditCategoryPage';

const App = () => {
    return (
        <Router>
            <Switch>
                <Route exact path="/categories" component={CategoriesIndex} />
                <Route path="/categories/create" component={CategoryForm} />
                <Route path="/categories/edit/:id" component={CategoryForm} />
            </Switch>
        </Router>
    );
};


export default App;