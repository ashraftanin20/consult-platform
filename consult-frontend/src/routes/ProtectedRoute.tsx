import { Navigate, Outlet } from "react-router-dom";
import { useAuth } from "../hooks/useAuth";

type Props = {
    allowedRoles?: string[];
};

const ProtectedRoute = ({ allowedRoles }: Props) => {
    const { user, isAuthenticated } = useAuth();

    if (!isAuthenticated) {
        return <Navigate to="/login" replace />;
    }

    if (
        allowedRoles &&
        !allowedRoles.some(role => 
            user?.roles?.includes(role)
        )
    ) {
        return <Navigate to="/unauthorized" replace />;
    }

    return <Outlet />;
}

export default ProtectedRoute;