import axios from "axios";
import { Service } from "./globalService";

const services = new Service();

// mengambil semua addon tanpa syarat
const getAll = async () => {
  return await services.AxiosInstance.post("/api/getalladdon").catch((e) =>
    console.log(e)
  );
};

// mengambil semua addon bersamaan dengan status transaksi apakah dibayar atau belum
// jika belum akan tetap ditampilkan namun status transaksinya belum dibeli
const getAddonWithTrans = async (id_user) => {
  return await services.AxiosInstance.post("/api/getaddonwithtrans", {
    id_user,
  }).catch((e) => console.log(e));
};

// buat transaksi
const postTrans = async (data) => {
  return await services.AxiosInstance.post("/api/posttrans", data).catch((e) =>
    console.log(e)
  );
};

// update status addon yang dilakukan oleh admin
const updateStat = async (id_addon, status) => {
  return await services.AxiosInstance.post("/api/updatestat", {
    id_addon,
    status,
  }).catch((e) => console.log(e));
};

// mengambil route yang aktif atau user yang sudah membeli addonnya
const getActivatedRoutes = async (id_user) => {
  console.log(id_user);
  return await services.AxiosInstance.post("/api/getroutes", {
    id_user,
  }).catch((e) => console.log(e));
};

// install addon ke direktori base
const installAddon = async (pluginName) => {
  return await axios
    .post("/api/install_plugin", {
      pluginName,
    })
    .then((res) => {
      console.log(res);
    });
};

// copot/hapus addon dari direktori base
const uninstallAddon = async (pluginName) => {
  return axios
    .post("/api/uninstall_plugin", {
      pluginName,
    })
    .then((res) => {
      console.log(res);
    });
};

// ini saya iseng buat kode virtual acount hehe
const rndNoCard = () => {
  let rnd = Math.random().toString(36).toUpperCase().substring(2, 7);
  let curr = new Date();
  let y = curr.getFullYear();
  let m = curr.getMonth() + 1;
  let d = curr.getDate();
  let h = curr.getHours();
  let s = curr.getSeconds();

  return `VA${y}${m}${d}${h}${s}${rnd}`;
};

export {
  rndNoCard,
  getAll,
  postTrans,
  updateStat,
  getActivatedRoutes,
  installAddon,
  uninstallAddon,
  getAddonWithTrans,
};
