import { useState } from "react";
import axios from "axios";
// import Header from "./Components/Header";
export default function Login() {
    const [email, setEmail] = useState("");
    //   لاستقبال البيانات نستخدم useEffect
    const [password, setPassword] = useState("");
    const [accept, setAccept] = useState(false);
    const [emailError, setEmailError] = useState("");
    async function Submit(e) {
        let flag = true;
        e.preventDefault();
        setAccept(true);
        if (password.length < 8) {
            flag = false;
        } else flag = true;
        try {
            if (flag) {
                // send Data
                let res = await axios.post("http://127.0.0.1:8000/api/login", {
                    email: email,
                    password: password,
                });
                if (res.status === 200) {
                    //if register done succesfully{
                    // window.localStorage.setItem("email", email);
                    window.localStorage.setItem("token", res.data.data.token);
                    window.location.pathname = "/";
                }
            }
        } catch (error) {
            setEmailError(error.response.status); // for state that the email was in database
        }
    }

    return (
        <div className="grand">
            {/* <Header /> */}
            <div className="parent container">
                <div className="register">
                    <form onSubmit={Submit}>
                        <label htmlFor="email">Email:</label>
                        <input
                            id="email"
                            type="email"
                            placeholder="Email..."
                            required
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                        />
                        {accept && emailError === 422 && (
                            <p className="error">Email is already been taken</p>
                        )}
                        <label htmlFor="password">Password:</label>
                        <input
                            id="password"
                            type="password"
                            placeholder="Password..."
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                        />
                        {password.length < 8 && accept && (
                            <p className="error">
                                password must be more than 8 Char
                            </p>
                        )}

                        <div style={{ textAlign: "center" }}>
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}
