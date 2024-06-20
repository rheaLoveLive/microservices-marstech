import { deleteCookie, setCookie } from "cookies-next";
import { Service } from "./globalService";

const services = new Service();

// login
const login = async (email, password) => {
  return await services.AxiosInstance.post("/api/signin", {
    email,
    password,
  })
    .then((res) => {
      // memasukkan data ke cookie
      if (res) {
        const cookieOpt = {
          maxAge: 60 * 60 * 24 * 7, // One week
        };
        console.log(res);

        setCookie(
          "current_user",
          JSON.stringify(res.data.data.user),
          cookieOpt
        );
      }
    })
    .catch((e) => alert(e));
};

// registrasi pembuatan user (ini akan mendefault role menjadi user bisa dilihat di APIAuthCtrl di laravel)
const register = async (name, email, password) => {
  return await services.AxiosInstance.post("/api/signup", {
    name: name,
    email: email,
    password: password,
  })
    .then((res) => {
      console.log(res);
    })
    .catch((e) => console.log(e));
};

// hapus cookie
const logout = async () => {
  return deleteCookie("current_user");
};

export { login, register, logout };
