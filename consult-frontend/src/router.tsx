import { createBrowserRouter } from "react-router-dom";
import ProtectedRoute from "./routes/ProtectedRoute";
import Home from "./pages/public/Home";
import Login from "./pages/auth/Login";
import Register from "./pages/auth/Register";
import AdminDashboard from "./pages/admin/AdminDashboard";
import ProfessionalDashboard from "./pages/professional/ProfessionalDashboard";
import ClientDashboard from "./pages/client/ProfessionalDashboard";
import Unauthorized from "./pages/Unauthorized";
import DashboardLayout from "./routes/DashboradLayout";

export const router = createBrowserRouter([
    {
        element: <ProtectedRoute />,
        children: [
            {
                path: "/", element: <Home />
            }
        ]
    },
    {
        element: <ProtectedRoute />,
        children: [
            {
                element: <DashboardLayout />,
                children: [
                    { path: "/admin", element: <AdminDashboard /> },
                    { path: "/professional", element: <ProfessionalDashboard /> },
                    { path: "/client", element: <ClientDashboard /> },
                ],
            }
        ]
    },
    {
        path: "/login", element: <Login />,
    },
    {
        path: "/regiser", element: <Register />
    },
    {
        path: "/unauthorized", element: <Unauthorized />
    }
])