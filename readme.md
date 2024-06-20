# tabel addon

- status <br/>
  0 = tidak terinstall <br/>
  1 = terinstall<br/>
  2 = maintenance<br/>

# tabel transaksi

- status_trans<br/>
  0 = belum dibeli<br/>
  1 = dalam proses pembayaran<br/>
  2 = dibeli<br/>

# NOTE!!!

 *pembuatan plugin nya harus memiliki struktur yang sama dengan base karena plugin itu sama dengan clone dari base namun dengan penambahan halaman pada direktori pages/pages/\**

 *untuk penambahan components,style,public harus di dalam folder dengan nama plugin tersebut misal :*

- components
  --- plugin_x
  ----- component.js
  ----- component2.js

- styles
  --- plugin_x
  ----- style.css
  ----- style2.css

- public
  --- plugin_x
  ----- images
  ------- blabla.jpg
  ------- blabla2.jpg

*untuk install dan uninstal itu merupakan internal api anda bisa menemukanya di dalam folder api pada pages di base*
