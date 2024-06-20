import { Button } from "primereact/button";
import styles from "@/styles/plugin_fb/button.module.scss";
import { useRouter } from "next/router";

const ActionBody = ({ id }) => {
  const router = useRouter();

  const handleEdit = (id, status) => {
    console.log(id + status);
    router.push({ pathname: "/pages/plugin_ig/form", query: { id, status } });
  };
  const handleDel = (id) => {
    console.log(router.replace(router.asPath));

    const apiUrl = "http://localhost:8000/api/delbioig";

    fetch(apiUrl, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id: id }),
    })
      .then((response) => response.json())
      .then((res) => {
        router.replace(router.asPath);
        console.log(router.asPath);
      })
      .catch((e) => console.error("Error:", e));
  };

  return (
    <div>
      <div className="flex gap-2 justify-center">
        <Button
          className={styles.edit}
          aria-label="Edit"
          onClick={() => handleEdit(id, "edit")}>
          <span className="flex align-items-center px-2 bg-blue-500 text-white">
            <i className="pi pi-file-edit"></i>
          </span>
          <span className="px-3 py-2 flex align-items-center text-white">
            Edit
          </span>
        </Button>
        <Button
          className={styles.delete}
          aria-label="Delete"
          onClick={() => handleDel(id)}>
          <span className="flex align-items-center px-2 bg-bluegray-800 text-[white]">
            <i className="pi pi-trash"></i>
          </span>
          <span className="px-3 py-2 flex align-items-center text-[white]">
            Del
          </span>
        </Button>
      </div>
    </div>
  );
};

export default ActionBody;
