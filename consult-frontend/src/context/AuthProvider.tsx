import { useState, type ReactNode } from "react";
import { AuthContext } from "./AuthContext";
import type { User } from "../type/User";

export const AuthProvider = ({ children }: { children: ReactNode}) => {
    const [user, setUser] = useState<User | null>(null);

    const login = (data: {token: string; user: User}) => {
        localStorage.setItem("token", data.token);
        setUser(data.user);
    }

    const logout = () => {
        localStorage.removeItem("token");
        setUser(null);
    }

    return (
        <AuthContext.Provider value={{ user, login, logout }}>
            {children}
        </AuthContext.Provider>
    );
}