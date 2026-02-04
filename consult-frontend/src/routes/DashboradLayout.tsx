import { Outlet, Link } from "react-router-dom";
import { useAuth } from "../hooks/useAuth";

const DashboardLayout = () => {
    const { user, logout } = useAuth();

    return (
        <div style={{ display: "flex", minHeight: "100vh" }}>
            <aside style={{ width: 220, padding: 20, background: "#f4f4f4" }}>
                <h3>Dashboard</h3>

                {user?.roles.includes("admin") && (
                    <Link to="/admin">Admin</Link>
                )}

                {user?.roles.includes("professional") && (
                    <Link to="/professional">Professional</Link>
                )}

                {user?.roles.includes("client") && (
                    <Link to="client">Client</Link>
                )}

                <br /><br />
                <button onClick={logout}>Logout</button>

            </aside>

            <main style={{ flex: 1, padding: 24 }}>
                <Outlet />
            </main>
        </div>
    );
};

export default DashboardLayout;