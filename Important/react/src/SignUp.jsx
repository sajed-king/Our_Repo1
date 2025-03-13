import { useState } from "react";
import axios from "axios";
// import Header from "../src/Component/Header.jsx";
export default function SignUp() {
    const [name, setName] = useState(""); //لإعادة تحميل الصفحة
    const [email, setEmail] = useState("");
    //   لاستقبال البيانات نستخدم useEffect
    const [password, setPassword] = useState("");
    const [passwordR, setPasswordR] = useState("");
    const [accept, setAccept] = useState(false);
    const [emailError, setEmailError] = useState("");
    async function Submit(e) {
        let flag = true;
        e.preventDefault();
        setAccept(true);
        if (name === "" || password.length < 10 || passwordR != password) {
            flag = false;
        } else flag = true;
        try {
            if (flag) {
                // send Data
                let res = await axios.post(
                    "http://127.0.0.1:8000/api/register",
                    {
                        name: name,
                        username: "Ali",
                        email: email,
                        password: password,
                    }
                );
                console.log(res.data.data.token);

                if (res.status === 200) {
                    //if register done succesfully{
                    // window.localStorage.setItem("email", email);
                    window.localStorage.setItem("token", res.data.data.token);
                    window.location.pathname = "/";
                    console.log("1000");
                }
            }
        } catch (error) {
            console.log();
            setEmailError(error.response.status); // for state that the email was in database
        }
    }

    return (
        <div className="grand">
            {/* <Header /> */}

            <div className="parent">
                <div className="register">
                    <form onSubmit={Submit}>
                        {/* <form > */}
                        <label htmlFor="name">Name:</label>
                        <input
                            id="name"
                            type="text"
                            placeholder="Name..."
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                        />
                        {name === "" && accept && (
                            <p className="error">Username is required</p>
                        )}
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
                        {password.length < 10 && accept && (
                            <p className="error">
                                password must be more than 10 Char
                            </p>
                        )}
                        <label htmlFor="repassword">Repeat Password:</label>
                        <input
                            id="repassword"
                            type="password"
                            placeholder="RepeatPassword..."
                            value={passwordR}
                            onChange={(e) => setPasswordR(e.target.value)}
                        />
                        {passwordR != password && accept && (
                            <p className="error">Password does not match</p>
                        )}
                        <div style={{ textAlign: "center" }}>
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}
