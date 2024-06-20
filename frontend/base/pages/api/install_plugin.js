import fs from "fs-extra";
import path from "path";


const handler = async (req, res) => {
  const { pluginName } = req.body;

  if (!pluginName) {
    return res.status(404).json({ error: "Kesalahan pada nama plugin" });
  }

  try {
    // destinasi
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

    // source file/folder
    const srcPages = path.resolve(
      process.cwd(),
      `../${pluginName}/pages/pages/${pluginName}`
    );
    const srcComponents = path.resolve(
      process.cwd(),
      `../${pluginName}/components/${pluginName}`
    );
    const srcStyles = path.resolve(
      process.cwd(),
      `../${pluginName}/styles/${pluginName}`
    );
    const srcPublic = path.resolve(
      process.cwd(),
      `../${pluginName}/public/${pluginName}`
    );

    // cek jika plugin sudah terinstall
    const isPathExist = await fs.pathExists(pagesDest).then((exists) => exists);

    // jika true maka return response
    if (isPathExist) {
      return res.status(201).json({
        message: `plugin ${pluginName}  sudah terinstall`,
      });
    }

    // jika false, install
    // copy component
    await fs.ensureDir(componentsDest);
    await fs.copy(srcComponents, componentsDest);

    // Copy styles
    await fs.ensureDir(stylesDest);
    await fs.copy(srcStyles, stylesDest);

    // Copy public
    await fs.ensureDir(publicDest);
    await fs.copy(srcPublic, publicDest);

    // Copy pages
    await fs.ensureDir(pagesDest);
    await fs.copy(srcPages, pagesDest);

    return res.status(200).json({
      message: `plugin ${pluginName} berhasil diinstall`,
    });
  } catch (error) {
    return res.status(500).json({
      error: `gagal menginstall plugin ${pluginName} karena ${error}`,
    });
  }
};

export default handler;
