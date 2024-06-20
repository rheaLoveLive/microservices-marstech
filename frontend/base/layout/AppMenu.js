import React, { useContext, useEffect, useState } from "react";
import AppMenuitem from "./AppMenuitem";
import { LayoutContext } from "./context/layoutcontext";
import { MenuProvider } from "./context/menucontext";
import Link from "next/link";
import { getCookie } from "cookies-next";
import { getActivatedRoutes } from "../services/addonsService";

const AppMenu = () => {
  const { layoutConfig } = useContext(LayoutContext);
  const [user, setUser] = useState(null);

  // ini untuk menyimpan addon sidebar/ routenya
  const [addonR, setAddonR] = useState([
    {
      label: "Shop",
      icon: "pi pi-fw pi-shopping-cart",
      to: "/addon_shop",
    },
  ]);

  //
  const [sideBar, setSideBar] = useState([]);

  // memgambil data user dari cookie
  useEffect(() => {
    const userCookie = getCookie("current_user");
    if (userCookie) {
      setUser(JSON.parse(userCookie));
    }
  }, []);

  // mengambil data route menurut user yang sudah membeli 
  useEffect(() => {
    if (user) {
      getActivatedRoutes(user.id).then((res) => {
        const data = res.data.data || [];
        const grouped = groupByAddon(data);
        setSideBar(getNested(grouped));
        addonManager(user.role);
      });
    }
  }, [user]);

  // mengelompokkan route yang sama plugin nya
  const groupByAddon = (data) => {
    return data.reduce((acc, item) => {
      if (!acc[item.id_addon]) {
        acc[item.id_addon] = [];
      }
      acc[item.id_addon].push(item);
      return acc;
    }, {});
  };

  // membuat sebuah struktur object nested sesuai struktur yang diinginkan sidebar primereact
  const getNested = (grouped) => {
    return Object.keys(grouped).map((key) => {
      const addonData = grouped[key];
      console.log(addonData);
      return {
        label: addonData[0].addon_name,
        icon: "pi pi-fw pi-sitemap",
        items: addonData.map((subDt) => ({
          label: subDt.name,
          icon: "pi pi-fw pi-sitemap",
          to: subDt.path,
        })),
      };
    });
  };

  // ini untuk menampilkan addon manager saat user merupakan admin
  const addonManager = (role) => {
    if (role === "admin" || role === "superadmin") {
      setAddonR([
        ...addonR,
        {
          label: "Plugin Manager",
          icon: "pi pi-fw pi-sliders-v",
          to: "/plugin_manager",
        },
      ]);
    } else {
      setAddonR([
        {
          label: "Shop",
          icon: "pi pi-fw pi-shopping-cart",
          to: "/addon_shop",
        },
      ]);
    }
  };

  const model = [
    {
      label: "Home",
      items: [
        { label: "Dashboard", icon: "pi pi-fw pi-home", to: "/" },
        {
          label: "Add-on",
          icon: "pi pi-fw pi-sitemap",
          items: addonR,
        },
      ],
    },
    {
      label: "App",
      items: sideBar,
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
