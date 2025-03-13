// import { useEffect, useState } from "react";
// import axios from "axios";
// import { Link } from "react-router-dom";

// const Users = () => {
//   // const [users, setUsers] = useState([]);
//   const [runUseEffect, setRun] = useState(0);//specially for changing when delete
//   // for state of too many request (more than 60 in minute or second???)
//   // useEffect(() => {
//   //   fetch("https://127.0.0.1:8000/api/user/show")
//   //     .then((res) => res.json())
//   //     .then((data) => setUsers(data));
//   // }, [runUseEffect]);
//   async function deleteUser(id) {
//     try{
//       const res = await axios.delete(`https://127.0.0.1:8000/api/user/delete/${id}`);
//       if (res.status === 200){

//         setRun((prev)=> prev+1);
//       }
//     }catch{
//       console.log("none");
//     }
//   }
//   const showUsers = users.map((user, index) => (
//     <tr key={index}>
//       <td>{index + 1}</td>
//       <td>{user.name}</td>
//       <td>{user.email}</td>
//       <td>
//         {/* this is for experinment  */}
//         <Link to={`${user.id}`}/>
//           <i
//             className="fa-solid fa-pen-to-square"
//             style={{ color: "#74afb9", paddingRight: "15px" }}
//           ></i>
//         <i
//           onClick={() => deleteUser(user.id)}
//           className="fa-solid fa-trash"
//           style={{ color: "red", cursor: "pointer" }}
//         ></i>
//       </td>
//     </tr>
//   ));
//   return (
//     <div style={{ padding: "20px" }}>
//       <table>
//         <thead>
//           <tr>
//           <th>Id</th>
//           <th>User</th>
//           <th>Email</th>
//           <th>Action</th>
//           </tr>
//         </thead>
//         <tbody>
//           {showUsers}
//           <tr>
//             {/* this is for experinment */}
//             <td>1</td>
//             <td>ahmed</td>
//             <td>ahmed@gmial.com</td>
//             <td>
//               <i
//                 className="fa-solid fa-pen-to-square"
//                 style={{ color: "#74afb9", paddingRight: "15px" }}
//               ></i>
//               <i
//                 className="fa-solid fa-trash"
//                 style={{ color: "red", cursor: "pointer" }}
//               ></i>
//             </td>
//           </tr>
//           <tr>
//             {/* this is for experinment */}
//             <td>2</td>
//             <td>Sajed</td>
//             <td>sajed@gmial.com</td>
//             <td>
//               <i
//                 className="fa-solid fa-pen-to-square"
//                 style={{ color: "#74afb9", paddingRight: "15px" }}
//               ></i>
//               <i
//                 className="fa-solid fa-trash"
//                 style={{ color: "red", cursor: "pointer" }}
//               ></i>
//             </td>
//           </tr>
//         </tbody>
//       </table>
//     </div>
//   );
// };

// export default Users;
