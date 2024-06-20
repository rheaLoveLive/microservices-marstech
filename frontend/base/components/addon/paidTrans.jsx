import { useRouter } from "next/router";

const Paid = () => {
  const router = useRouter();

  return (
    <div>
      <div>sudah dibayar</div>
      <div>
        <button onClick={() => router.push("/addons")}>kembali?</button>
      </div>
    </div>
  );
};

export default Paid;
