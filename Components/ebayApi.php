<?php

class eBayAPI {

    // API request variables
    var $endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
    var $version = '1.0.0';  // API version supported by your application
    var $appid = 'MyAppID';  // Replace with your own AppID
    var $globalid = 'EBAY-US';  // Global ID of the eBay site you want to search (e.g., EBAY-DE)
    var $results;
    

    public function __construct($appid)
    {
        $this->appid = $appid;
    }

    public function filters(){
        // Create a PHP array of the item filters you want to use in your request
        return  array(
            array(
            'name' => 'MaxPrice',
            'value' => '25',
            'paramName' => 'Currency',
            'paramValue' => 'USD'),
            array(
            'name' => 'FreeShippingOnly',
            'value' => 'true',
            'paramName' => '',
            'paramValue' => ''),
            array(
            'name' => 'ListingType',
            'value' => array('AuctionWithBIN','FixedPrice'),
            'paramName' => '',
            'paramValue' => ''),
          );
    }

    public function build_url()
    {

        $filters = $this->filters();
        // Construct the findItemsByKeywords HTTP GET call
        $apicall = $this->endpoint."?";
        $apicall .= "OPERATION-NAME=findItemsByKeywords";
        $apicall .= "&SERVICE-VERSION=".$this->version;
        $apicall .= "&SECURITY-APPNAME=".$this->appid;
        $apicall .= "&GLOBAL-ID=".$this->globalid;
        $apicall .= "&keywords=".$this->keywords;
        $apicall .= "&paginationInput.entriesPerPage=10";
        // $apicall .= $this->buildURLArray($filters);

        return $apicall;
    }

    public function item_search($keywords)
    {
        $this->keywords = urlencode($keywords);

        $apicall = $this->build_url();
        // Load the call and capture the document returned by eBay API
        $resp = simplexml_load_file($apicall);

        // Check to see if the request was successful, else print an error
        if ($resp->ack == "Success") {
            $results = $resp->searchResult;
        }
        // If the response does not indicate 'Success,' print an error
        else {
            $results  = false;
        }

        $this->results = $results;
        return $results;
    }

    // Generates an indexed URL snippet from the array of item filters
    public function buildURLArray ($filterarray) {
        $urlfilter = '';
        $i = '0';  // Initialize the item filter index to 0
      // Iterate through each filter in the array
      foreach($filterarray as $itemfilter) {
        // Iterate through each key in the filter
        foreach ($itemfilter as $key =>$value) {
          if(is_array($value)) {
            foreach($value as $j => $content) { // Index the key for each value
              $urlfilter .= "&itemFilter($i).$key($j)=$content";
            }
          }
          else {
            if($value != "") {
              $urlfilter .= "&itemFilter($i).$key=$value";
            }
          }
        }
        $i++;
      }
      return "$urlfilter";
    } // End of buildURLArray function

}

?>
