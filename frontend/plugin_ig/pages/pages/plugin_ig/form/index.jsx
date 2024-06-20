import { useRouter } from "next/router";
import { InputText } from "primereact/inputtext";
import { useEffect, useState } from "react";
import { InputTextarea } from "primereact/inputtextarea";
import { Dropdown } from "primereact/dropdown";
import { Button } from "primereact/button";

const Form = () => {
  const router = useRouter();
  const [status, setStatus] = useState("create");
  const [id, setId] = useState(null);
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({
    agama: "",
    alamat: "",
    nama: "",
    email: "",
    no_hp: "",
  });

  const agamas = [
    { value: "Islam" },
    { value: "Ortodoks" },
    { value: "Protestan" },
    { value: "Katolik" },
    { value: "Hindu" },
    { value: "Budha" },
    { value: "Konghuchu" },
  ];

  useEffect(() => {
    // cek jika mode edit
    if (status === "edit") {
      getDataEdit("http://localhost:8000/api/editbioig", { id });
    }
  }, [status, id]);

  useEffect(() => {
    // set status dan id jika ada
    const { status, id } = router.query;
    setStatus(status || "create");
    setId(id || null);
  }, [router.query]);

  // handle semua form kecuali agama karena dropdown yang berisi json
  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData((prevData) => ({ ...prevData, [id]: value }));
  };

  // handle form agama yang berisi json
  const handleAgamaChange = (e) => {
    setFormData((prevData) => ({ ...prevData, agama: e.value }));
  };

  const handleSubmit = () => {
    setLoading(true);
    const apiUrl =
      status === "edit"
        ? "http://localhost:8000/api/updatebioig"
        : "http://localhost:8000/api/postbioig";

    // post data menurut mode
    fetch(apiUrl, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ ...formData, id }),
    })
      .then((response) => response.json())
      .then((res) => {
        setLoading(false);
        if (res) {
          console.log(res);
          router.back();
        }
      })
      .catch((e) => {
        setLoading(false);
        console.error("Error:", e);
      });
  };

  // ambil data menurut id
  const getDataEdit = (apiUrl, data) => {
    fetch(apiUrl, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((res) => {
        if (res) {
          setFormData(res.data);
        }
      })
      .catch((e) => console.error("Error:", e));
  };

  return (
    <main>
      <div className="card">
        <h5 className={`font-semibold text-[17.5px] mb-[15px]`}>
          {status === "edit" ? "Edit" : "Tambah data"}
        </h5>
        <div className="p-fluid formgrid flex flex-wrap">
          <div className="field col-12 md:col-6">
            <label htmlFor="nama">Nama</label>
            <InputText
              id="nama"
              value={formData.nama}
              type="text"
              onChange={handleChange}
            />
          </div>
          <div className="field col-12 md:col-6">
            <label htmlFor="email">Email</label>
            <InputText
              id="email"
              value={formData.email}
              type="email"
              onChange={handleChange}
            />
          </div>
          <div className="field col-12">
            <label htmlFor="alamat">Alamat</label>
            <InputTextarea
              id="alamat"
              value={formData.alamat}
              rows="4"
              onChange={handleChange}
            />
          </div>
          <div className="field col-12 md:col-6">
            <label htmlFor="nohp">Nomer HP</label>
            <InputText
              id="no_hp"
              value={formData.no_hp}
              type="text"
              placeholder="089123321444"
              onChange={handleChange}
            />
          </div>
          <div className="field col-12 md:col-3">
            <label htmlFor="state">Agama</label>
            <Dropdown
              id="state"
              value={formData.agama}
              onChange={handleAgamaChange}
              options={agamas}
              optionLabel="value"
              placeholder="Select One"
            />
          </div>
          <div className="field col-12 md:col-3">
            <Button
              className="mt-[33px] justify-center font-semibold"
              onClick={() => handleSubmit()}
              severity={status === "edit" ? "warning" : "danger"}>
              {!loading ? "Submit" : <i className="pi pi-spin pi-spinner"></i>}
            </Button>
          </div>
        </div>
      </div>
    </main>
  );
};

export default Form;
