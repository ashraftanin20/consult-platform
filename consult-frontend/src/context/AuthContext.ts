import { createContext } from "react";
import { type User } from "../type/User";

export interface AuthContextType {
    user: User | null;
    login:  (data: { token: string; user: User}) => void;
    logout: () => void;
}

export const AuthContext = createContext<AuthContextType | null>(null); 