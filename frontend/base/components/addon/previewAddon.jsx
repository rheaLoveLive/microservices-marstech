import Image from "next/image";
import Rating from "./rating";
import styles from "@/styles/addons.module.scss";
const no_pic_addon = require("@/public/images/plugin.svg");

const Preview = ({ data }) => {
  return (
    <>
      {/* icon */}
      <Image
        src={data.foto_icon ? data.foto_icon : no_pic_addon}
        alt={data.name}
        width={100}
        height={100}
        className={`rounded-[50%] mx-auto`}
      />
      {/* text */}
      <div className={`${styles.text} mt-[10px] xs:ml-[20px] w-[100%]`}>
        <h4 className={`font-bold text-[18px]`}>{data.name}</h4>
        <p className={`text-[15px]`}>
          <b>Category :</b> {data.category}
        </p>
      </div>
      {/* rating */}
      <div className={`block  mb-[20px]`}>
        <p className={`text-[15px]`}>
          <b>
            {new Intl.NumberFormat("id-ID", {
              style: "currency",
              currency: "IDR",
            }).format(data.price)}
          </b>
        </p>
        {<Rating rating={data.rating} />}
      </div>
    </>
  );
};

export default Preview;
