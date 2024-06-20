import React, { useState } from "react";
import styles from "@/styles/register.module.scss";
import Link from "next/link";
import Image from "next/image";
import { register } from "@/services/authService";
import { useRouter } from "next/router";
import hero from "../../../public/images/hero_login2.jpg";

const Register = () => {
  const [username, setUsername] = useState("");
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
    if (username === "") {
      errors.username = "Maaf Nama Anda Kosong";
    }
    if (Object.keys(errors).length === 0) {
      register(username, email, password).then((res) => {
        setLoading(false);
        route.push("/auth/login");
        // console.log(res);
      });
    }

    if (errors.username != undefined) {
      alert(errors.username);
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
        {/* left content */}
        <div
          className={`${styles.left} hidden md:flex flex-col items-center rounded-e-[50px] p-[20px] pt-[50px] bg-[#dfeaec] relative overflow-hidden`}>
          <div className={`${styles.content} z-[2]`}>
            <h3 className="text-[#546161] text-[25px] font-bold mb-[30px] ">
              You&apos;re New Here
            </h3>
            <p className="mb-[30px]">
              We&apos;re delighted that you&apos;ve decided to register with us.
              Your decision to join our products is a fantastic step, and
              we&apos;re eager to provide you with a fulfilling experience!
            </p>
            <Link
              className="transition-all transition-duration-200 py-[5px] px-[50px] border-[1px] border-[#a3a3a3] rounded-[5px] ease-in hover:bg-white hover:border-white"
              href={"/auth/login"}>
              Signin
            </Link>
          </div>
          <Image
            className={`${styles.hero} absolute w-[300px] bottom-[-50px] right-0 z-[1]`}
            src={hero}
            alt="hero"
          />
        </div>

        {/* forms */}
        <div className={`${styles.right} p-[20px] pt-[50px] w-[100%]`}>
          {/* form signup */}
          <div
            className={`${styles.signup} flex-col flex justify-center items-center flex-wrap gap-[20px] text-center`}>
            {/* title */}
            <h3 className="text-[#546161] text-[25px] font-bold mb-[10px]">
              Signup
            </h3>
            {/* input username */}
            <div className={`${styles.email_input} ${styles.input_wrap}`}>
              <label htmlFor="username">
                <i className="pi pi-user"></i>
              </label>
              <input
                type="text"
                name="username"
                id="username"
                placeholder="username"
                value={username}
                onChange={(e) => setUsername(e.target.value)}
              />
            </div>
            {/* input email */}
            <div className={`${styles.email_input} ${styles.input_wrap}`}>
              <label htmlFor="email_signup">
                <i className="pi pi-envelope"></i>
              </label>
              <input
                type="email"
                name="email_signup"
                id="email_signup"
                placeholder="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
              />
            </div>
            {/* input password */}
            <div className={`${styles.password_input} ${styles.input_wrap}`}>
              <label htmlFor="password_signup">
                <i className="pi pi-lock"></i>
              </label>
              <input
                type="password"
                name="password_signup"
                id="password_signup"
                placeholder="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </div>
            {/* link */}
            <p>
              already have an account?{" "}
              <Link
                className="hover:text-[#929292] font-bold"
                href={"/auth/login"}>
                Signin Here
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
      </div>
    </section>
  );
};

export default Register;

Register.getLayout = function getLayout(page) {
  return <React.Fragment>{page}</React.Fragment>;
};
