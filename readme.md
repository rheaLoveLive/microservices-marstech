# tabel addon

- status
  0 = tidak terinstall
  1 = terinstall
  2 = maintenance

# tabel transaksi

- status_trans
  0 = belum dibeli
  1 = dalam proses pembayaran
  2 = dibeli

# NOTE!!!

# pembuatan plugin nya harus memiliki struktur yang sama dengan base karena plugin itu sama dengan clone dari base namun dengan penambahan halaman pada direktori pages/pages/\*

# untuk penambahan components,style,public harus di dalam folder dengan nama plugin tersebut misal :

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

# untuk install dan uninstal itu merupakan internal api anda bisa menemukanya di dalam folder api pada pages di base 
