import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { registerRequest } from "../../api/auth";
import { useAuth } from "../../hooks/useAuth";

const Register = () =>  {
    const { login } = useAuth();
    const navigate = useNavigate();

    const [form, setForm] = useState({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        role: "client",
    });

    const [error, setError] = useState("");

    const handleChange = (
        e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>
    ) => {
        setForm({...form, [e.target.name]: e.target.value});
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setError("");

        try {
            const data =    await registerRequest(form);
            login(data);
            navigate("/");
        } catch (err: unknown) {
            if (err instanceof Error) {
                setError(err.message)
            } else {
                setError("Register failed");
            }
        }
    };

    return (
        <div className="max-w-md mx-auto py-12 px-4">
            <h1 className="text-2xl font-bold mb-4">Register</h1>

            {error && <p className="text-red-500 mb-2">{error}</p>}

            <form onSubmit={handleSubmit} className="space-y-4">
                <input
                    name="name"
                    placeholder="Full name"
                    className="w-full border px-3 py-2 rounded"
                    value={form.name}
                    onChange={handleChange}
                />

                <input
                    name="email"
                    type="email"
                    placeholder="Email"
                    className="w-full border px-3 py-2 rounded"
                    value={form.email}
                    onChange={handleChange}
                />

                <input
                    name="password"
                    type="password"
                    placeholder="Password"
                    className="w-full border px-3 py-2 rounded"
                    value={form.password}
                    onChange={handleChange}
                />

                
                <input
                    name="password_confirmation"
                    type="password"
                    placeholder="Confirm password"
                    className="w-full border px-3 py-2 rounded"
                    value={form.password_confirmation}
                    onChange={handleChange}
                />

                <select
                    name="role"
                    className="w-full border px-3 py-2 rounded"
                    value={form.role}
                    onChange={handleChange}
                >
                    <option value="client">Client</option>
                    <option value="professional">Professional</option>
                </select>

                <button className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Register
                </button>
            </form>
        </div>
    )
}

export default Register;