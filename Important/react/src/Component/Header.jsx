// for video 52
import {Link} from "react-router-dom"
export default function Header() {
  function handleLogOut() {
    // window.localStorage.removeItem("email");
    window.localStorage.removeItem("token");
    window.location.pathname = "/";
  }
  return (

      <div className="top-bar container">
        <nav className="d-flex">
          <div className="d-flex ">
            <div className="logo">
              <img src="../../logo.png" alt="unknown"/>
            </div>

            {/* <Link to="" className="link">
              <h6>Home</h6>
            </Link> */}
            {/* <Link to="" className="link">
              <h6>About</h6>
            </Link> */}
          </div>
          <div className="d-flex">
            {!window.localStorage.getItem("token") ? (
              <>
                <Link
                  to="/register"
                  style={{ textAlign: "center" }}
                  className="register-nav"
                >
                  Register
                </Link>
                <Link
                  to="/login"
                  style={{ textAlign: "center" }}
                  className="register-nav"
                >
                  Login
                </Link>
              </>
            ) : (
              <div className="register-nav" onClick={handleLogOut}>
                Log Out
              </div>
            )}
          </div>
        </nav>
      </div>
  );
}
// export default  Header;