import { Link } from "react-router-dom";

const Navbar = () => {
    return (
        <nav className="bg-white shadow-md px-6 py-4 flex justify-between items-center">
            <Link to="/" className="text-xl font-bold text-blue-600">
                Consult Platfrom
            </Link>

            <div className="space-x-4">
                <Link to="/" className="text-gray-600 hover:text-blue-600">
                    Home
                </Link>
                <Link to="/about" className="text-gray-600 hover:text-blue-600">
                    About
                </Link>
                <Link to="/login" className="text-gray-600 hover:text-blue-600">
                    Login
                </Link>
                <Link to="/register" className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Register
                </Link>
            </div>

        </nav>
    );
};

export default Navbar;