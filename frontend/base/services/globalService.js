const { default: axios } = require("axios");

class Service {
  AxiosInstance;
  constructor() {
    // ini untuk menentukan baseurl api yang akan kita pakai
    this.AxiosInstance = axios.create({
      baseURL: "http://localhost:8000",
      timeout: 30000,
      timeoutErrorMessage: "Request Time Out!",
    });
  }
}

export { Service };
