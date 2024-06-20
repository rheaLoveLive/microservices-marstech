import fs from "fs-extra";
import path from "path";

const handler = async (req, res) => {
  const { pluginName } = req.body;

  if (!pluginName) {
    return res.status(404).json({ error: "kesalahan pada nama plugin" });
  }

  try {
    // direktori
    const pagesDest = path.resolve(
      process.cwd(),
      `./pages/pages/${pluginName}`
    );
    const stylesDest = path.resolve(process.cwd(), `./styles/${pluginName}`);
    const componentsDest = path.resolve(
      process.cwd(),
      `./components/${pluginName}`
    );
    const publicDest = path.resolve(process.cwd(), `./public/${pluginName}`);

    // hapus plugin
    await fs.remove(pagesDest);
    await fs.remove(stylesDest);
    await fs.remove(publicDest);
    await fs.remove(componentsDest);
    res.status(200).json({
      message: `berhasil menghapus plugin ${pluginName}`,
    });
  } catch (error) {
    res.status(500).json({
      error: `gagal uninstall plugin ${pluginName} karena ${error}`,
    });
  }
};

export default handler;
