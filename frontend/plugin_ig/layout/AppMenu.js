import React, { useContext } from "react";
import AppMenuitem from "./AppMenuitem";
import { LayoutContext } from "./context/layoutcontext";
import { MenuProvider } from "./context/menucontext";

const AppMenu = () => {
  const { layoutConfig } = useContext(LayoutContext);

  const model = [
    {
      label: "Home",
      items: [
        {
          label: "Plugin_ig",
          icon: "pi pi-fw pi-instagram",
          items: [
            { label: "Data", icon: "pi pi-fw pi-chart-bar", to: "/pages/plugin_ig/data" },
            { label: "Form", icon: "pi pi-fw pi-file-edit", to: "/pages/plugin_ig/form" },
          ],
        },
      ],
    },
  ];

  return (
    <MenuProvider>
      <ul className="layout-menu">
        {model.map((item, i) => {
          return !item.seperator ? (
            <AppMenuitem item={item} root={true} index={i} key={item.label} />
          ) : (
            <li className="menu-separator"></li>
          );
        })}
      </ul>
    </MenuProvider>
  );
};

export default AppMenu;
