import { useEffect, useState } from "react";
import styles from "@/styles/addons.module.scss";
import Preview from "@/components/addon/previewAddon";
import PayingBy from "@/components/addon/payingMethod";
import { getCookie } from "cookies-next";

const Detail = () => {
  const [data, setData] = useState([]);
  const [user, setUser] = useState([]);
  const [isPayClick, setPayClick] = useState(false);

  // ambil data yang disimpan pada localstorage dan cookie
  useEffect(() => {
    const getUser = getCookie("current_user");
    const dataParam = localStorage.getItem("data");
    setData(JSON.parse(dataParam));
    setUser(JSON.parse(getUser));
  }, []);

  return (
    <main>
      <div className={`${styles.wrapper} relative`}>
        {/* container box */}
        <div
          className={`${styles.detail_box}  gap-[20px] w-[100%] flex flex-wrap rounded-[5px] shadow-md bg-white p-[20px]`}>
          <div
            className={`${
              styles.left_box
            } shadow-md bg-[#e7e7e7] p-[10px] w-[60%] flex-grow rounded-md flex ${
              isPayClick ? "" : "items-center"
            } relative`}>
            {isPayClick ? (
              <PayingBy addonData={data} user={user} />
            ) : (
              <Preview data={data} />
            )}
          </div>
          {/* right box */}
          <div
            className={`${styles.right_box} shadow-md rounded-md p-[10px] bg-[#e7e7e7] relative flex items-center flex-grow`}>
            <div className={`w-full`}>
              {/* detail */}
              <table className={`w-full`}>
                <tbody>
                  <tr>
                    <td className={`text-left font-bold text-black`}>
                      Detail Harga :
                    </td>
                  </tr>
                  <tr className="text-right border-b-2 border-black">
                    <td className={`text-left font-bold text-black`}>
                      Harga :
                    </td>
                    <td>
                      {new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                      }).format(data.price)}
                    </td>
                  </tr>
                  <tr className="text-right">
                    <td className={`text-left font-bold text-black`}>
                      Total :
                    </td>
                    <td>
                      {new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                      }).format(data.price)}
                    </td>
                  </tr>
                </tbody>
              </table>

              {!isPayClick && (
                <button
                  onClick={() => setPayClick(true)}
                  className={`float-end mt-[20px] shadow-md rounded-[5px] font-semibold text-white py-[5px] px-[50px] bg-[#2d2f3c] hover:bg-slate-500 transition-all ease-in delay-150`}>
                  Pay
                </button>
              )}
            </div>
          </div>
        </div>
      </div>
    </main>
  );
};

export default Detail;
