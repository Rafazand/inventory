import axios from 'axios';

const API_URL = 'http://localhost:8000/api/categories';

class CategoryService {
    static getAll() {
        return axios.get(API_URL);
    }

    static getById(id) {
        return axios.get(`${API_URL}/${id}`);
    }

    static create(data) {
        return axios.post(API_URL, data);
    }

    static update(id, data) {
        return axios.put(`${API_URL}/${id}`, data);
    }

    static delete(id) {
        return axios.delete(`${API_URL}/${id}`);
    }
}

export default CategoryService;