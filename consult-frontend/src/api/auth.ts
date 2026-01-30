import api from "./axios";

export const loginRequest = async (email: string, password: string) => {
    const response = await api.post("/login", { email, password });
    return response.data;
};

export const registerRequest = async (data: {
    name: string,
    email: string,
    password: string,
    password_confirmation: string,
    role: string,
}) => {
    const response = await api.post("/register", data);
    return response.data;
}