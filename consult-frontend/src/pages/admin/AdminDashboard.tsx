import { useState, useEffect } from "react";
import { fetchAdminDashboard } from "../../api/dashboard";

type AdminState = {
    total_users: number,
    professionals: number,
    clients: number
};

const AdminDashboard = () => {
    const [data, setData] = useState<AdminState | null>(null);

    useEffect(() => {
        fetchAdminDashboard().then(setData);
    }, []);

    if (!data) return <p>Loading...</p>;

    return (
        <>
            <h2>Admin Dashboard</h2>
            <p>Total Users: {data.total_users}</p>
            <p>Professionals: {data.professionals}</p>
            <p>Clients: {data.clients}</p>
        </>
    );
};

export default AdminDashboard;