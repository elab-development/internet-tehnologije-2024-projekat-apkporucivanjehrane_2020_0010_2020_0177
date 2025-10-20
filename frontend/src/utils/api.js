import axios from 'axios';

const API_URL = 'http://localhost:8000/api';

// Kreiranje axios instance
const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Dodavanje tokena u svaki request
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// API metode
export const authAPI = {
  register: (data) => api.post('/register', data),
  login: (data) => api.post('/login', data),
  logout: () => api.post('/logout'),
  getUser: () => api.get('/user'),
};

export const kategorijeAPI = {
  getAll: () => api.get('/kategorije'),
  getOne: (id) => api.get(`/kategorije/${id}`),
  create: (data) => api.post('/kategorije', data),
  update: (id, data) => api.put(`/kategorije/${id}`, data),
  delete: (id) => api.delete(`/kategorije/${id}`),
};

export const restoraniAPI = {
  getAll: (params) => api.get('/restorani', { params }),
  getOne: (id) => api.get(`/restorani/${id}`),
  create: (data) => api.post('/restorani', data),
  update: (id, data) => api.put(`/restorani/${id}`, data),
  delete: (id) => api.delete(`/restorani/${id}`),
};

export const jelaAPI = {
  getAll: (params) => api.get('/jela', { params }),
  getOne: (id) => api.get(`/jela/${id}`),
  create: (data) => api.post('/jela', data),
  update: (id, data) => api.put(`/jela/${id}`, data),
  delete: (id) => api.delete(`/jela/${id}`),
};

export const porudzbineAPI = {
  getAll: () => api.get('/porudzbine'),
  getOne: (id) => api.get(`/porudzbine/${id}`),
  create: (data) => api.post('/porudzbine', data),
  updateStatus: (id, status) => api.patch(`/porudzbine/${id}/status`, { status }),
};

export const vremeAPI = {
  getBeograd: () => api.get('/vreme/beograd'),
  getGrad: (grad) => api.get('/vreme', { params: { grad } }),
};

export default api;

