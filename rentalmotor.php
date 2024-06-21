

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
body {
    font-family: Arial, sans-serif;
    background-color: #FEC771;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 400px;
}

/* form div {
    margin-bottom: 15px;
} */

label {
    font-size: 14px;
    margin-right: 10px;
    width: 150px;
}

input[type="number"],
input[type='text'],
select {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: red;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

.sama {
    font-family: Arial, sans-serif;
    border: 1px solid #ddd;
    padding: 20px;
    margin: 20px auto;
    width: 300px;
    background-color: #f9f9f9;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.sama h1, .sama h2, .sama h3, .sama h4, .sama h5, .sama h6 {
    text-align: center;
}

.sama p {
    margin: 10px 0;
}

.sama .header, .sama .footer {
    text-align: center;
    font-weight: bold;
    margin-bottom: 20px;
}

.sama .details {
    text-align: left;
    line-height: 1.6;
}

.sama .total {
    font-size: 1.2em;
    margin-top: 20px;
    text-align: right;
    font-weight: bold;
}

.sama .separator {
    border-top: 1px dashed #ccc;
    margin: 20px 0;
}

.beda {
    margin-bottom: 200px;
}

.tulisan{
    display:flex;
    justify-content: center;
}

    </style>
</head>
<body>
    <div class="beda">
        <div class="tulisan">
            <h1 style="dispplay: flex; justify-content: center;">Sewa Motor</h1>
        </div>

    <form action="" method="post">
        <div style="display: flex;"> 
            <label for="nama">Masukan Nama:</label>
            <input type="text" name="nama" id="nama" require>
        </div>
        <div style="display: flex;"> 
            <label for="number">Masukan Hari:</label>
            <input type="number" name="waktu" id="number" require>
        </div>
        <div style="display: flex;">
            <label for="">Plih Motor</label>
            <select name="jenis" id="" require>
                <option value="Scoopy">scopy</option>
                <option value="Beat">beat</option>
                <option value="Vario">vario</option>
                <option value="Aerox">aeorox</option>
            </select>
        </div>
        <button type="submit" name="beli">Beli</button>
    </form>
    <?php
    //panggil filenya
    
class Data {
    public $member;
    public $jenis;
    public $waktu;
    public $diskon;
    protected $pajak;
    private $Scoopy, $Beat, $Vario, $Aerox;
    private $listmember = ['kafka','arko','ardissya'];

    function __construct(){
        $this->pajak = 10000;
    }

    public function getMember(){
        if(in_array($this->member, $this->listmember)){
            return "member";
        }else{
            return "non-member";
        }
    }
    public function setHarga($jenis1, $jenis2, $jenis3, $jenis4){
        $this->Scoopy = $jenis1;
        $this->Beat = $jenis2;
        $this->Vario = $jenis3;
        $this->Aerox = $jenis4;
    }
    public function getHarga() {
        $data["Scoopy"] = $this-> Scoopy;
        $data["Beat"] = $this-> Beat;
        $data["Vario"] = $this-> Vario;
        $data["Aerox"] = $this-> Aerox;
        return $data;
    }
}

class Rent extends Data {
    public function hargaRental () {
        $dataHarga = $this->getHarga()[$this->jenis];
        $diskon = $this->getMember() == "member" ? 5 : 0;
        if ($this->waktu === 1) {
            $bayar = ($dataHarga - ($dataHarga * $diskon / 100)) + $this->pajak;
        }else{
            $bayar = (($dataHarga * $this->waktu) - ($dataHarga * $diskon/100)) + $this->pajak;
        }
        return [$bayar, $diskon];
    }

    
    public function pembayaran(){
        echo '<hr>';
        echo "<center>";
        echo $this->member . " berstatus sebgai " . $this->getMember() . " mendapatkan diskon sebesar " . $this->hargaRental()[1] . "%";
        echo "<br>";
        echo "Jenis motor yang dirental adalah " . $this->jenis . " selama " . $this->waktu . " hari";
        echo "<br>";
        echo "Harga rental per-harinya : Rp. " . number_format($this->getHarga()[$this->jenis]);
        echo "<br>";
        echo "<b>Besar yang harus dibayarkan adalah: Rp. ". number_format($this->hargaRental()[0]). " (<i>Termasuk Pajak)</i></b>";
        echo "</center>";
    }
}

//baru di buka.langsung set harga
$logic = new Rent();
$logic->SetHarga(100000,150000,180000,200000);
//kalau uda piks beli,jalanan
if(isset($_POST['beli'])){
    $logic->jenis = $_POST['jenis'];
    $logic->waktu = $_POST['waktu'];
    $logic->member = $_POST['nama'];
    //abis kirim nilai form,proses harganya 
    $logic->hargaRental();
    //cetak harga
    $logic->pembayaran(); 
}

    ?>
    </div>
</body>
</html>
