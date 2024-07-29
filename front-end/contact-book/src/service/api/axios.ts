// services/contactService.ts
import axios from 'axios';

const API_URL = 'http://localhost:8000/api';

// Configuração global para o axios com withCredentials habilitado
const axiosInstance = axios.create({
  baseURL: API_URL,
  withCredentials: true,
  headers: {
    'Content-Type': 'multipart/form-data',
    // Adicione outros headers se necessário, por exemplo:
    // 'Authorization': `Bearer ${token}`,
  },
});

const getToken = () => {
  return localStorage.getItem('token');
};

export const createContact = async (data: FormData) => {
  try {
    const response = await axiosInstance.post('/contact', data, {
      headers: {
        Authorization: `Bearer ${getToken()}`,
      },
    });
    return response.data;
  } catch (error: any) {
    if(error.response.data.message) {
      throw new Error('Esse email ja está sendo usado por outro usuário');
    }
    if(error.response.data.phone) {
      throw new Error(error.response.data.phone);
    }
  }
};

export const updateContact = async (data: FormData) => {
  try {
    const response = await axiosInstance.post(`/contact/update`, data, {
      headers: {
        Authorization: `Bearer ${getToken()}`,
      },
    });
    return response.data;
  } catch (error: any) {
    if(error.response.data.message) {
      throw new Error('Esse email ja está sendo usado por outro usuário');
    }
    if(error.response.data.phone) {
      throw new Error(error.response.data.phone);
    }
  }
};

export const getOneContact = async (id: string) => {
  try {
    const response = await axiosInstance.get(`/contact/${id}`, {
      headers: {
        Authorization: `Bearer ${getToken()}`,
      },
    });
    return response.data;
  } catch (error: any) {
    throw new Error(error.response?.data?.message || 'Erro ao buscar contato');
  }
};

export const getAllContact = async () => {
  try {
    const response = await axiosInstance.get('/contact', {
      headers: {
        Authorization: `Bearer ${getToken()}`,
      },
    });
    return response.data['data'];
  } catch (error: any) {
    throw new Error(error.response?.data?.message || 'Erro ao buscar contatos');
  }
};

export const deleteContact = async (id: string) => {
  try {
    const response = await axiosInstance.delete(`/contact/${id}`, {
      headers: {
        Authorization: `Bearer ${getToken()}`,
      },
    });
    return response.data;
  } catch (error: any) {
    throw new Error(error.response?.data?.message || 'Erro ao deletar contato');
  }
};

export const login = async (data: FormData) => {
  try {
    const response = await axiosInstance.post(`/login`, data);
    localStorage.setItem('token', response.data.token);
  } catch (error: any) {
    throw new Error(error.response?.data?.message || 'Erro ao criar usuário');
  }
};

export const register = async (data: FormData) => {
  try {
    return await axiosInstance.post(`/user`, data);
  } catch (error: any) {
    throw new Error(error.response?.data?.message || 'Erro ao registrar usuário');
  }
};

export const logout = async () => {
  try {
    await axiosInstance.post(`/logout`, {}, {
      headers: {
        Authorization: `Bearer ${getToken()}`,
      },
    });
    localStorage.removeItem('token');
  } catch (error: any) {
    throw new Error(error.response?.data?.message || 'Erro ao fazer logout');
  }
};


