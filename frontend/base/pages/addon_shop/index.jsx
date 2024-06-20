import { useRouter } from "next/router";
import { useEffect, useState } from "react";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import styles from "@/styles/addons.module.scss";
import Link from "next/link";
import Image from "next/image";
import { getAddonWithTrans } from "@/services/addonsService";
import { getCookie } from "cookies-next";
const no_pic_addon = require("@/public/images/plugin.svg");

const Addons = () => {
  const [user, setUser] = useState({});
  const [data, setData] = useState([]);
  const [isLoad, setLoad] = useState(false);
  const route = useRouter();

  // ambil data user dan masukkan kedalam state 
  useEffect(() => {
    const getUser = getCookie("current_user");
    console.log(JSON.parse(getUser));
    if (getUser) {
      const parseJson = JSON.parse(getUser);
      setUser(parseJson);
    }
    setLoad(true);
  }, []);

  // ambil id user lalu gunakan untuk mengambil data addon menurut transaksi nya 
  useEffect(() => {
    if (user?.id) {
      getAddonWithTrans(user.id)
      .then((res) => {
        console.log(res?.data.data);
        if (!res.data.error) {
          console.log(res?.data.data);
          setData(res.data.data);
          setLoad(false);
        } else {
          setData([]);
          setLoad(false);
        }
      })
      .catch((e) => {
        console.log(e);
        setData([]);
        setLoad(true);
      });
    }
  }, [user]);

  // skeleton
  const Loading = () => {
    let i = [1, 2, 3, 4];
    return (
      <>
        {i.map((_, index) => (
          <li
            key={index}
            className={`${styles.box_item} rounded-[5px] flex bg-white p-[20px] items-center shadow-md`}>
            <Skeleton height={70} width={70} />
            {/* text */}
            <div className={`${styles.text} w-[100%] ml-[20px]`}>
              <Skeleton height={14} width={200} borderRadius={0} />
              <Skeleton height={14} width={200} borderRadius={0} />
              <Skeleton height={14} width={200} borderRadius={0} />
            </div>
          </li>
        ))}
      </>
    );
  };

  // pergi ke tampilan detail dari addon dan masukkan data addon kedalam localstorage
  const handleClick = (item) => {
    route.push(`/addon_shop/${item.id}`);

    // set stored state
    localStorage.setItem("data", JSON.stringify(item));
  };

  return (
    <main>
      <h1>Addons</h1>
      <div className={`${styles.wrapper} flex items-center py-[20px] relative`}>
        <ul
          className={`${styles.box_container} grid gap-[10px] w-[100%] grid-cols-auto`}>
          {/* box */}
          {isLoad ? (
            <Loading />
          ) : (
            data?.map((item) => {
              return (
                <li
                  key={item.id}
                  className={`${styles.box_item} rounded-[10px] flex bg-white p-[20px] items-center shadow-md`}>
                  {/* icon */}
                  <Image
                    className={`${styles.img} w-[70px] h-[70px] rounded-[50%] mr-[20px]`}
                    src={item.icon ? item.icon : no_pic_addon}
                    alt={item.name}
                    width={50}
                    height={50}
                  />
                  {/* text */}
                  <div className={`${styles.text} w-[100%]`}>
                    <h4 className={`font-bold text-[16px]`}>{item.name}</h4>
                    <p className={`text-[12px]`}>
                      <b>Category :</b> {item.category}
                    </p>
                    <h5 className={`text-[12px]`}>
                      Harga :{" "}
                      <b>
                        {new Intl.NumberFormat("id-ID", {
                          style: "currency",
                          currency: "IDR",
                        }).format(item.price)}
                      </b>
                    </h5>

                    {/* btn */}
                    <div
                      className={`${styles.actions} flex items-center py-[5px] relative mt-[20px]`}>
                      <button
                        className={`${
                          item.status_trans >= 1 && item.status_trans <= 2
                            ? "font-bold text-black"
                            : ""
                        }`}
                        disabled={
                          item.status_trans >= 1 && item.status_trans <= 2
                        }
                        onClick={() => {
                          handleClick(item);
                        }}>
                        {item.status_trans >= 1 && item.status_trans <= 2
                          ? "Dibeli"
                          : "Install"}
                      </button>
                      <Link
                        href={"#"}
                        className={`${styles.link} absolute right-0`}>
                        <i className="pi pi-share-alt"></i>
                      </Link>
                    </div>
                  </div>
                </li>
              );
            })
          )}
        </ul>
      </div>
    </main>
  );
};

export default Addons;
