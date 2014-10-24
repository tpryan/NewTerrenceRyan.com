<?php
class URLTest extends PHPUnit_Framework_TestCase
{
    

    private $baseDevURL = "http://localhost:8080";

    public function testMainURL() {
        $urlToTest = $this->baseDevURL;
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogURL() {
        $urlToTest = $this->baseDevURL . "/blog/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogPostURL() {
        $urlToTest = $this->baseDevURL . "/blog/index.php/little-update-to-brackets-reflow-cleaner-2/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogRedirectURL() {
        $urlToTest = $this->baseDevURL . "/blog";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==301, $status . " " . $urlToTest);
    }

    public function testSVGURL() {
        $urlToTest = $this->baseDevURL . "/max/2013/programmingcss/preso/img/zeldman.svg";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }




    public function getStatusCode($url){
        $headers = get_headers($url);
        $status_array = explode(" ", $headers[0]);
        return $status_array[1];
    }


}
;?>