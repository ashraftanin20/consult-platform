import { useState, useEffect } from "react";
import { fetchProfessionalDashboard } from "../../api/dashboard";

const ProfessionalDashboard = () => {
    const [count, setCount] = useState<number | null>(null);

    useEffect(() => {
        fetchProfessionalDashboard().then(data => 
            setCount(data.upcoming_appointments)
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

export default ProfessionalDashboard;