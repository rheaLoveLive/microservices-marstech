import React, { useEffect, useState } from "react";
import styles from "@/styles/login.module.scss";
import Image from "next/image";
import Link from "next/link";
import { login } from "@/services/authService";
import { useRouter } from "next/router";
import hero from "../../../public/images/hero_login2.jpg";

const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [isLoading, setLoading] = useState(false);
  const route = useRouter();

  const handleSubmit = () => {
    setLoading(true);

    // validation
    let errors = {};

    const emailChara =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (email === "") {
      errors.email = "Maaf Email Anda Kosong";
    }
    if (!emailChara.test(email)) {
      errors.email = "Maaf Email Anda Tidak Sesuai";
    }
    if (password === "") {
      errors.password = "Maaf Password Anda Kosong";
    }
    if (password?.length < 6) {
      errors.password = "Maaf Password Anda Kurang dari 6 Karakter";
    }
    if (Object.keys(errors).length === 0) {
      login(email, password).finally(() => {
        setLoading(false);
        route.push("/");
      });
    }

    if (errors.email != undefined) {
      alert(errors.email);
    }
    if (errors.password != undefined) {
      alert(errors.password);
    }
  };

  return (
    <section
      className={`${styles.outer} flex items-center justify-center h-[100vh] w-[100vw]`}>
      <div
        className={`${styles.container} flex relative w-[90%] md:w-[70%] bg-white h-[70%] rounded-[10px]`}>
        {/* forms */}
        <div className={`${styles.left} p-[20px] pt-[50px] w-[100%]`}>
          {/* form signin */}
          <div
            className={`${styles.signin} flex-col flex justify-center items-center flex-wrap gap-[20px] text-center`}>
            {/* title */}
            <h3 className="text-[#546161] text-[25px] font-bold mb-[30px]">
              Signin
            </h3>
            {/* input email */}
            <div className={`${styles.email_input} ${styles.input_wrap}`}>
              <label htmlFor="email_signin">
                <i className="pi pi-envelope"></i>
              </label>
              <input
                type="emails"
                name="email_signin"
                id="email_signin"
                placeholder="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
              />
            </div>
            {/* input password */}
            <div className={`${styles.password_input} ${styles.input_wrap}`}>
              <label htmlFor="password_signin">
                <i className="pi pi-lock"></i>
              </label>
              <input
                type="password"
                name="password_signin"
                id="password_signin"
                placeholder="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
            </div>
            {/* link */}
            <p>
              have no account?{" "}
              <Link
                className="hover:text-[#929292] font-bold"
                href={"/auth/register"}>
                Signup Here
              </Link>
            </p>

            {/* button */}
            <button
              onClick={() => handleSubmit()}
              disabled={isLoading}
              className={`${
                styles.submit
              } py-[5px] w-[65%] rounded-[5px] bg-[#a9b4b5] ${
                isLoading ? "" : "hover:scale-[.98] hover:text-white"
              }`}
              type="submit">
              {isLoading ? <i class="pi pi-spin pi-spinner"></i> : "Submit"}
            </button>
          </div>
        </div>

        {/* right content */}
        <div
          className={`${styles.right} hidden md:flex flex-col items-center rounded-s-[50px] p-[20px] pt-[50px] bg-[#dfeaec] relative overflow-hidden`}>
          <div className={`${styles.content} z-[2]`}>
            <h3 className="text-[#546161] text-[25px] font-bold mb-[30px] ">
              Welcome back
            </h3>
            <p className="mb-[30px]">
              We&apos;re thrilled you&apos;ve chosen to explore what we have to
              offer. Your presence here is greatly appreciated, and we&apos;re
              excited to accompany you on this digital journey!
            </p>
            <Link
              className="transition-all transition-duration-200 py-[5px] px-[50px] border-[1px] border-[#a3a3a3] rounded-[5px] ease-in hover:bg-white hover:border-white"
              href={"/auth/register"}>
              Signup
            </Link>
          </div>
          <Image
            className={`${styles.hero} absolute w-[300px] bottom-[-50px] right-0 z-[1]`}
            src={hero}
            alt="hero"
          />
        </div>
      </div>
    </section>
  );
};

export default Login;

Login.getLayout = function getLayout(page) {
  return <React.Fragment>{page}</React.Fragment>;
};
