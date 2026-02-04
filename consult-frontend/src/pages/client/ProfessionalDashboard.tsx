import { useState, useEffect } from "react";
import { fetchClientDashboard } from "../../api/dashboard";

const ClientDashboard = () => {
    const [count, setCount] = useState<number | null>(null);

    useEffect(() => {
        fetchClientDashboard().then(data => 
            setCount(data.my_appointments)
        );
    }, []);

    if (count === null) return <p>Loading...</p>;

    return (
        <>
            <h2>Professional Dashboard</h2>
            <p>Upcoming Appointments: {count}</p>
        </>
    );
};

export default ClientDashboard;