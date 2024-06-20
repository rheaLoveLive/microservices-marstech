import { postTrans, rndNoCard } from "@/services/addonsService";
import styles from "@/styles/addons.module.scss";
import { useState } from "react";

const PayingBy = ({ user, addonData }) => {
  const [methode, setMethode] = useState(false);
  const [isLoading, setLoading] = useState(false);

  const onClickPay = () => {
    const diskon = () => addonData.diskon * addonData.price;
    const gTotal = () => addonData.price - diskon();

    setLoading(true);

    const send = {
      id_user: user.id,
      id_addon: addonData.id,
      nm_addon: addonData.name,
      pay_trans: addonData.price,
      status_trans: 2,
      type_payment_trans: methode ? "QRIS" : "VA",
      number_card_trans: methode ? null : rndNoCard(),
      diskon_trans: diskon(),
      gtotal_trans: gTotal(),
    };

    postTrans(send).then(() => {
      setLoading(false);
    });
  };

  return (
    <div>
      <h4 className="font-bold">Pilih Metode Pembayaran</h4>
      <div className={`${styles.switch} my-[10px]`}>
        <label
          className={`${
            styles.slider
          } cursor-pointer rounded-[5px] text-white text-[14px] font-semibold flex relative w-[250px] bg-[#2d2f3c] px-[10px] p-[4px] space-x-[10px] ${
            methode ? "after:translate-x-[120px]" : ""
          }`}
          htmlFor="check">
          <div className="w-[110px] text-center">Virtual Account</div>
          <div className="w-[110px] text-center">QRIS</div>
        </label>
        <input
          value={methode}
          type="checkbox"
          name="check"
          id="check"
          hidden
          onChange={(e) => setMethode(e.target.checked)}
        />
      </div>
      <div>
        {methode ? (
          <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum
            ipsum excepturi quisquam deserunt quod nulla delectus sapiente velit
            error quidem?
          </p>
        ) : (
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda,
            maxime!
          </p>
        )}
      </div>
      <button
        onClick={() => onClickPay()}
        className={`mt-[10px] text-[15px] shadow-md rounded-[5px] font-semibold text-white py-[2px] px-[50px] bg-[#2d2f3c] hover:bg-slate-500 transition-all ease-in delay-150`}>
        {isLoading ? (
          <i className="pi pi-spin pi-spinner"></i>
        ) : (
          `Pay using ${methode ? "QRIS" : "VA"}`
        )}
      </button>
    </div>
  );
};

export default PayingBy;
