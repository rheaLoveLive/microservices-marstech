import {
  getAll,
  installAddon,
  uninstallAddon,
  updateStat,
} from "@/services/addonsService";
import { getCookie } from "cookies-next";
import Image from "next/image";
import { useEffect, useState } from "react";
const noPicAddon = require("@/public/images/plugin.svg");

const AddonManager = () => {
  const [data, setData] = useState([]);
  const [user, setUser] = useState([]);
  const [isLoading, setLoading] = useState({});

  useEffect(() => {
    const getUser = getCookie("current_user");
    if (getUser) {
      const parseJson = JSON.parse(getUser);
      setUser(parseJson);
    }
  }, []);

  useEffect(() => {
    getData(user.id);
  }, [user]);

  const getData = () => {
    getAll().then((res) => {
      console.log(res);
      if (!res.data.error) {
        setData(res.data.data);
        const addon = res.data.data;

        addon.map((ad) => {
          if (ad.status > 0 && ad.status !== 2) {
            installAddon(ad.name);
          } else if (ad.status === 0) {
            uninstallAddon(ad.name);
          }
        });
      } else {
        setData([]);
      }
    });
  };

  const handleEdit = (id, status) => {
    setLoading((isload) => ({ ...isload, [id]: true }));
    updateStat(id, status).then((res) => {
      if (res.data.data) {
        const stat = res.data.data.status;
        if (stat > 0 && stat !== 2) {
          installAddon(res.data.data.name);
        } else if (stat === 0) {
          uninstallAddon(res.data.data.name);
        }
      }
      getData(user.id);
      setLoading((isload) => ({ ...isload, [id]: false }));
    });
  };

  return (
    <main>
      <div
        onClick={(event) => event.stopPropagation()}
        className={`bg-white overflow-y-auto p-[15px] rounded-md shadow-md`}>
        <div
          className={`text-[20px] pb-[10px] relative items-center flex justify-between  border-b-[1px] mb-[10px] border-[#cdcdcd]`}>
          <h2 className={``}>Install Addon</h2>
        </div>

        <ul className={` space-y-[10px] w-[100%] `}>
          {data.map((item, index) => (
            <li
              key={index}
              className={`flex items-center px-[10px] py-[2px] w-[100%] rounded-md hover:bg-slate-100`}>
              <Image
                alt={item.name}
                src={item.icon ? item.icon : noPicAddon}
                className={` w-[40px] h-[40px] rounded-[6px] mr-[10px]`}
              />
              <div>
                <h4>{item.name}</h4>
                <p
                  className={`${
                    item.status == 1
                      ? "text-[green]"
                      : item.status == 2
                      ? "text-yellow-400"
                      : "text-[red]"
                  } ml-auto`}>
                  {item.status == 1
                    ? "Installed"
                    : item.status == 2
                    ? "Maintenance"
                    : "Not Installed"}
                </p>
              </div>

              <div className="ml-auto space-x-2">
                {item.status == 0 || item.status == 2 ? (
                  <button
                    disabled={isLoading[item.id]}
                    onClick={() => handleEdit(item.id, 1)}
                    className={`py-[2px] px-[10px] hover:bg-slate-300 hover:text-[white] bg-slate-100 rounded-[6px]`}>
                    {!isLoading[item.id] ? (
                      <i className="pi pi-plus text-[12px]"></i>
                    ) : (
                      <i className="pi pi-spin pi-spinner"></i>
                    )}
                  </button>
                ) : (
                  <button
                    disabled={isLoading[item.id]}
                    onClick={() => handleEdit(item.id, 0)}
                    className={`py-[2px] px-[10px] hover:bg-slate-300 hover:text-[white]  bg-slate-100 rounded-[6px]`}>
                    {!isLoading[item.id] ? (
                      <i className="pi pi-minus text-[12px]"></i>
                    ) : (
                      <i className="pi pi-spin pi-spinner"></i>
                    )}
                  </button>
                )}

                <button
                  disabled={isLoading[item.id]}
                  onClick={() => handleEdit(item.id, 2)}
                  className={`py-[2px] px-[10px] hover:bg-slate-300 hover:text-[white] bg-slate-100 rounded-[6px]`}>
                  {!isLoading[item.id] ? (
                    <i className="pi pi-wrench text-[12px]"></i>
                  ) : (
                    <i className="pi pi-spin pi-spinner"></i>
                  )}
                </button>
              </div>
            </li>
          ))}
        </ul>
      </div>
    </main>
  );
};

export default AddonManager;
