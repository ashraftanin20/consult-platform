import api from "./axios";

export const fetchAdminDashboard = async () => {
    const { data } = await api.get("/admin/dashboard");
    return data;
};

export const fetchProfessionalDashboard = async () => {
    const { data } = await api.get("/professional/dashboard");
    return data
};

export const fetchClientDashboard = async () => {
    const { data } = await api.get("client/dashboard");
    return data;
}