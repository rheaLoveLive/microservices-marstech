import { DataTable } from "primereact/datatable";
import { Column } from "primereact/column";
import { Button } from "primereact/button";
import { InputText } from "primereact/inputtext";
import { useEffect, useState } from "react";
import ActionBody from "@/components/plugin_ig/actionBody";

export default function Home() {
  const [data, setData] = useState(null);
  const [filters, setFilters] = useState(null);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    getData("http://localhost:8000/api/getbioig");
  }, []);

  const getData = (apiUrl) => {
    setLoading(true);
    fetch(apiUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
      })
      .then((res) => {
        setData(res.data);
        setLoading(false);
      })
      .catch((error) => {
        setLoading(false);
        console.error("Error:", error.message);
      });
  };

  const renderHeader = () => {
    return (
      <div className="flex justify-content-between">
        <Button
          type="button"
          icon="pi pi-filter-slash"
          outlined
          // onClick={clearFilter1}
        />
        <span className="p-input-icon-left">
          <i className="pi pi-search" />
          <InputText
            // onChange={onGlobalFilterChange1}
            placeholder="Keyword Search"
          />
        </span>
      </div>
    );
  };

  const header = renderHeader();

  return (
    <main className={``}>
      <div className="card">
        <h5 className={`mb-[15px] font-semibold text-[17.5px] `}>
          Filter Menu
        </h5>
        <DataTable
          value={data}
          paginator
          className="p-datatable-gridlines"
          showGridlines
          rows={10}
          dataKey="id"
          filters={filters}
          filterDisplay="menu"
          loading={loading}
          header={header}
          emptyMessage="No customers found.">
          <Column
            field="nama"
            header="Nama"
            align="center"
            style={{ minWidth: "12rem" }}
          />
          <Column
            field="no_hp"
            header="Hanphone"
            align="center"
            style={{ minWidth: "12rem" }}
          />
          <Column
            field="alamat"
            header="Alamat"
            align="center"
            style={{ minWidth: "14rem" }}
          />
          <Column
            field="agama"
            header="Agama"
            align="center"
            style={{ minWidth: "10rem" }}
          />
          <Column
            field="email"
            header="Email"
            align="center"
            style={{ minWidth: "10rem" }}
          />
          <Column
            header="Action"
            align="center"
            style={{ minWidth: "10rem" }}
            body={(rowdt) => <ActionBody id={rowdt.id} getData={getData} />}
          />
        </DataTable>
      </div>
    </main>
  );
}
