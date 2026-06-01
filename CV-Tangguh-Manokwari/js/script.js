// =========================
// DATA PRODUK
// =========================

let products = JSON.parse(localStorage.getItem("products")) || [

    {
        nama: "Beras",
        harga: 75000,
        stok: 20,
        gambar: "images/beras.jpeg"
    },

    {
        nama: "Minyak Goreng",
        harga: 20000,
        stok: 15,
        gambar: "images/minyak.jpeg"
    },

    {
        nama: "Gula Pasir",
        harga: 18000,
        stok: 30,
        gambar: "images/gula.jpeg"
    }
];

// Simpan produk pertama kali
localStorage.setItem(
    "products",
    JSON.stringify(products)
);

// =========================
// TAMPILKAN PRODUK
// =========================

function displayProducts(){

    const produkContainer =
        document.getElementById("produk-container");

    if(!produkContainer) return;

    produkContainer.innerHTML = "";

    products.forEach((produk, index) => {

        let statusStok = "";

        if(produk.stok <= 5){

            statusStok = `
                <p style="color:red;font-weight:bold;">
                    Stok Hampir Habis
                </p>
            `;
        }

        produkContainer.innerHTML += `

            <div class="card">

                <img src="${produk.gambar}">

                <h3>${produk.nama}</h3>

                <p>
                    Rp ${produk.harga.toLocaleString("id-ID")}
                </p>

                <span class="stok">
                    Stok: ${produk.stok}
                </span>

                ${statusStok}

                <button onclick="addToCart(${index})">

                    <i class="fa-solid fa-cart-plus"></i>

                    Beli

                </button>

            </div>
        `;
    });
}

displayProducts();

// Ambil data cart dari localStorage
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Fungsi tambah ke keranjang
function addToCart(index){

    let produk = products[index];

    if(produk.stok <= 0){

        alert("Stok habis!");

        return;
    }

    cart.push({
        nama: produk.nama,
        harga: produk.harga
    });

    // Kurangi stok
    produk.stok -= 1;

    // Simpan perubahan
    localStorage.setItem(
        "cart",
        JSON.stringify(cart)
    );

    localStorage.setItem(
        "products",
        JSON.stringify(products)
    );

    alert(produk.nama + " berhasil ditambahkan!");

    displayProducts();
}

// Tampilkan keranjang
function displayCart(){

    const cartItems = document.getElementById("cart-items");
    const totalPrice = document.getElementById("total-price");

    if(!cartItems) return;

    cartItems.innerHTML = "";
    if(cart.length === 0){

        cartItems.innerHTML = `
            <div class="empty-cart">
                <i class="fa-solid fa-cart-shopping"></i>
    
                <p>
                    Keranjang masih kosong
                </p>
            </div>
        `;
    }

    let total = 0;

    cart.forEach((item, index) => {

        total += item.harga;

        cartItems.innerHTML += `
            <div class="cart-card">
                <h3>${item.nama}</h3>
                <p>Rp ${item.harga.toLocaleString()}</p>

                <button onclick="removeItem(${index})">
                    Hapus
                </button>
            </div>
        `;
    });

    totalPrice.innerText = "Total: Rp " + total;
}

// Hapus item
function removeItem(index){

    cart.splice(index, 1);

    localStorage.setItem("cart", JSON.stringify(cart));

    displayCart();
}

// Checkout
function checkout(){

    const nama = document.getElementById("nama").value;

    const nomorhp =
    document.getElementById("nomorhp").value;

    const alamat =
    document.getElementById("alamat").value;

    if(
        nama === "" ||
        nomorhp === "" ||
        alamat === ""
    ){

        alert("Nama dan alamat wajib diisi!");

        return;
    }

    // Data pesanan
    const pesanan = {
        nama: nama,
        nomorhp: nomorhp,
        alamat: alamat,
        barang: cart,
        status: "Menunggu"
    };

    // Ambil semua pesanan lama
    let semuaPesanan =
        JSON.parse(localStorage.getItem("pesanan")) || [];

    // Tambahkan pesanan baru
    semuaPesanan.push(pesanan);

    // Simpan
    localStorage.setItem(
        "pesanan",
        JSON.stringify(semuaPesanan)
    );

    // Kosongkan keranjang

    cart = [];

    localStorage.removeItem("cart");

    alert("Pesanan berhasil dikirim!");

    // Refresh
    window.location.href = "index.html";
}

// Tampilkan pesanan admin
function displayOrders(){

    const adminOrders =
        document.getElementById("admin-orders");

    if(!adminOrders) return;

    let semuaPesanan =
        JSON.parse(localStorage.getItem("pesanan")) || [];

    adminOrders.innerHTML = "";
    if(semuaPesanan.length === 0){

        adminOrders.innerHTML = `
            <div class="empty-cart">
    
                <i class="fa-solid fa-box-open"></i>
    
                <p>
                    Belum ada pesanan masuk
                </p>
    
            </div>
        `;
    
        return;
    }

    semuaPesanan.forEach((pesanan, index) => {

        let daftarBarang = "";

        pesanan.barang.forEach((item) => {

            daftarBarang += `
                <li>
                    ${item.nama} - Rp ${item.harga.toLocaleString()}
                </li>
            `;
        });

        adminOrders.innerHTML += `
            <div class="cart-card">

            <table class="info-pesanan">

            <tr>
                <td>
                <i class="fa-solid fa-user icon-user"></i>
                    Pelanggan
                </td>
        
                <td>:</td>
        
                <td>${pesanan.nama}</td>
            </tr>
        
            <tr>
                <td>
                <i class="fa-solid fa-phone icon-phone"></i>
                    Nomor HP
                </td>
        
                <td>:</td>
        
                <td>${pesanan.nomorhp}</td>
            </tr>
        
            <tr>
                <td>
                <i class="fa-solid fa-location-dot icon-location"></i>
                    Alamat
                </td>
        
                <td>:</td>
        
                <td>${pesanan.alamat}</td>
            </tr>
        
            <tr>
                <td>
                <i class="fa-solid fa-box icon-status"></i>
                    Status
                </td>
        
                <td>:</td>
        
                <td>
                    <span class="status ${pesanan.status}">
                        ${pesanan.status}
                    </span>
                </td>
            </tr>
        
        </table>

                <ul>
                    ${daftarBarang}
                </ul>

                <button onclick="updateStatus(${index})">
    Update Status
</button>

<button onclick="selesaiPesanan(${index})">
    Hapus Pesanan
</button>

            </div>
        `;
    });
}

// Hapus pesanan selesai
function selesaiPesanan(index){

    let semuaPesanan =
        JSON.parse(localStorage.getItem("pesanan")) || [];

    semuaPesanan.splice(index, 1);

    localStorage.setItem(
        "pesanan",
        JSON.stringify(semuaPesanan)
    );

    displayOrders();
}

// Update status pesanan
function updateStatus(index){

    let semuaPesanan =
        JSON.parse(localStorage.getItem("pesanan")) || [];

    let statusSekarang =
        semuaPesanan[index].status;

    if(statusSekarang === "Menunggu"){

        semuaPesanan[index].status = "Diproses";

    }else if(statusSekarang === "Diproses"){

        semuaPesanan[index].status = "Dikirim";

    }else if(statusSekarang === "Dikirim"){

        semuaPesanan[index].status = "Selesai";

    }

    localStorage.setItem(
        "pesanan",
        JSON.stringify(semuaPesanan)
    );

    displayOrders();
}

// Login Admin
function loginAdmin(){

    const username =
        document.getElementById("username").value;

    const password =
        document.getElementById("password").value;

    // Username & Password admin
    if(
        username === "admin" &&
        password === "12345"
    ){

        localStorage.setItem(
            "adminLogin",
            "true"
        );

        alert("Login berhasil!");

        window.location.href = "admin.html";

    }else{

        alert("Username atau password salah!");
    }
}

// Proteksi halaman admin
if(window.location.pathname.includes("admin.html")){

    const isLogin =
        localStorage.getItem("adminLogin");

    if(isLogin !== "true"){

        window.location.href = "login.html";
    }
}

displayOrders();

displayCart();

// =========================
// MONITORING STOK
// =========================

function displayStockMonitor(){

    const stockMonitor =
        document.getElementById("stock-monitor");

    if(!stockMonitor) return;

    stockMonitor.innerHTML = "";

    products.forEach((produk, index) => {

        stockMonitor.innerHTML += `

            <div class="cart-card">

                <h3>${produk.nama}</h3>

                <p>
                    Stok Saat Ini:
                    <strong>${produk.stok}</strong>
                </p>

                <input
                    type="number"
                    id="tambah-stok-${index}"
                    placeholder="Tambah stok"
                >

                <button onclick="tambahStok(${index})">

                    Tambah Barang Masuk

                </button>

            </div>
        `;
    });
}

displayStockMonitor();

function tambahStok(index){

    let input =
        document.getElementById(
            `tambah-stok-${index}`
        );

    let jumlah = parseInt(input.value);

    if(isNaN(jumlah) || jumlah <= 0){

        alert("Masukkan jumlah stok yang valid!");

        return;
    }

    products[index].stok += jumlah;

    localStorage.setItem(
        "products",
        JSON.stringify(products)
    );

    alert("Stok berhasil ditambahkan!");

    displayStockMonitor();

    displayProducts();
}