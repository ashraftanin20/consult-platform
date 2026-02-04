import { createContext } from "react";

export type AuthUser = {
  id: number;
  name: string;
  email: string;
  roles: string[];
};

export type AuthContextType = {
  user: AuthUser | null;
  token: string | null;
  isAuthenticated: boolean;
  login: (data: { user: AuthUser; token: string }) => void;
  logout: () => void;
};

export const AuthContext = createContext<AuthContextType | null>(null);
