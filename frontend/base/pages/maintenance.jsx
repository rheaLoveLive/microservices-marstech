import Image from "next/image";
const maaf = require("@/public/images/maaf.png");

const Maintenance = () => {
  return (
    <div className="">
      <div className="flex flex-column align-items-center justify-content-center gap-y-5">
        <Image src={maaf} alt="maaf" width={200} height={200} />
        <h1 className="font-bold text-2xl mb-2 text-center text-[#5f64ff] [text-shadow:_0_1px_2px_rgb(0_0_0_/_60%)]">
          Mohon bersabar plugin yang anda tuju sedang dalam perbaikan atau
          update silakan coba kembali dalam beberapa saat 
        </h1>
      </div>
    </div>
  );
};

export default Maintenance;
