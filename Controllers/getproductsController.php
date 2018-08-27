<?php
class getproductsController extends Controller
{

	//search input
    function index()
    {
        $this->render("index");
    }

    //ebay products
    function ebay()
    {
        require(ROOT . 'Components/ebayApi.php');
    	$product = $_POST['product'];
        $ebay = new eBayAPI("SmbatAgh-getProdu-PRD-159ccfefe-0c948359");
      	$result['items'] = $ebay->item_search($product);

        $this->set($result);
        $this->layout = 'clear';
       	$this->render("ebay");
    }

    //amazon products
    function amazon()
    {
        require(ROOT . 'Components/amazonApi.php');
        
       
        $amazon = new AmazonAPI("getproducts05-20", "AKIAIVMSA4KZY2UDNCFQ", "NFrv6xFeOT5qQlUxYaNEoN5CvGAmlbx2eZsB/RW3");
        $item = $amazon->item_search("the%20hunger%20games");
        $this->render("index");
    }
}
?>
