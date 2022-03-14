<?php
include("../adminsession.php");
include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include('src/BarcodeGeneratorSVG.php');
include('src/BarcodeGeneratorHTML.php');

if(isset($_GET['productid']))
{
$productid = $_GET['productid'];
}
//$prod_code=$cmn->getvalfield($connection,"m_product","prod_code","productid='$productid'");

$barcode=$cmn->getcode($connection,$tblname,$tblpkey,"1=1");

$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();
$generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();

//echo "<center>".$generatorHTML->getBarcode('123456789', $generatorPNG::TYPE_CODE_128)."<center>";
echo "<div style='margin-top:100px;' id='div' ><center>".$generatorSVG->getBarcode($prod_code, $generatorPNG::TYPE_CODE_128)."<center>$prod_code</div>";
//echo '<img src="data:image/png;base64,' . ba001234567895se64_encode($generatorPNG->getBarcode('123456789', $generatorPNG::TYPE_CODE_128)) . '">';

?>

<script>
var rotated = false;
var div = document.getElementById('div'),
        deg = rotated ? 0 : 0;

    div.style.webkitTransform = 'rotate('+deg+'deg)'; 
    div.style.mozTransform    = 'rotate('+deg+'deg)'; 
    div.style.msTransform     = 'rotate('+deg+'deg)'; 
    div.style.oTransform      = 'rotate('+deg+'deg)'; 
    div.style.transform       = 'rotate('+deg+'deg)'; 
    
    rotated = !rotated;
</script>