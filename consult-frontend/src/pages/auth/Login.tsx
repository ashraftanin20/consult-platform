import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { loginRequest } from "../../api/auth";
import { useAuth } from "../../hooks/useAuth";

const Login = () => {
    const { login } = useAuth();
    const navigate  = useNavigate();

    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState("");

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setError("");

        try {
            const data = await loginRequest(email, password);
            login(data);
            navigate("/");
        } catch (err: unknown) {
            if (err instanceof Error) {
                setError(err.message);
            } else {
                setError("Login failed");
            }
            

        }
    };

    return (
        <div className="max-w-md mx-auto py-12 px-4">
            <h1 className="text-2xl font-bold mb-4">Login</h1>

            {error && <p className="text-red-500 mb-2">{error}</p>}

            <form onSubmit={handleSubmit} className="space-y-4">
                 <input 
                    type="email"
                    placeholder="Email"
                    className="w-full border px-3 py-2 rounded"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                />

                <input 
                    type="password"
                    placeholder="Password"
                    className="w-full border px-3 py-2 rounded"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                />

                <button className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Login
                </button>
            </form>
        </div>
    );
};

export default Login;