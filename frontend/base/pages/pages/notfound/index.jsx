import React from "react";
import AppConfig from "../../../layout/AppConfig";
import Link from "next/link";

const NotFoundPage = () => {
  return (
    <div className="surface-ground flex align-items-center justify-content-center min-h-screen min-w-screen overflow-hidden">
      <div className="flex flex-column align-items-center justify-content-center">
        <span className="text-blue-500 font-bold text-3xl">404</span>
        <h1 className="text-900 font-bold text-5xl mb-2">Not Found</h1>
      </div>
    </div>
  );
};

NotFoundPage.getLayout = function getLayout(page) {
  return (
    <React.Fragment>
      {page}
      <AppConfig />
    </React.Fragment>
  );
};

export default NotFoundPage;
