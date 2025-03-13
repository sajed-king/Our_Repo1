// import SignUp from "../Assest/SignUp";
import { Route, Routes } from "react-router-dom";
// import Login from "./Login";
// import Dashboard from "./Dashboard";
// import Users from "./Users";
// import { useState } from 'react'
import Header from "./Component/Header";
import SignUp from "./SignUp";
import Login from "./Login";
import Dashboard from "./Dashboard";
// import Users from "./Users";
// import reactLogo from './assets/react.svg'
// import viteLogo from '/vite.svg'
import "./App.css";

function App() {
    // const [count, setCount] = useState(0)

    return (
        <div>
            <Header />
            <Routes>
                <Route path="/register" element={<SignUp />} />
                <Route path="/login" element={<Login />} />
                <Route path="/dashboard" element={<Dashboard />}>
                    {/* <Route path="users" element={<Users />}></Route> */}
                </Route>
            </Routes>
        </div>
    );
}
export default App;
