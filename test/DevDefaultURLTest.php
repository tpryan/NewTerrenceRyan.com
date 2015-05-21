<?php
class URLTest extends PHPUnit_Framework_TestCase
{
    

    private $baseURL = "http://localhost:8081";

    public function testMainURL() {
        $urlToTest = $this->baseURL;
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }


    public function testSVGURL() {
        $urlToTest = $this->baseURL . "/max/2013/programmingcss/preso/img/zeldman.svg";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testMAXURL() {
        $urlToTest = $this->baseURL . "/max/2013/programmingcss/preso/index.html";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testJPGURL() {
        $urlToTest = $this->baseURL . "/assets/img/book.jpg";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testPNGURL() {
        $urlToTest = $this->baseURL . "/assets/img/bookfull.png";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testCSSURL() {
        $urlToTest = $this->baseURL . "/assets/css/main.css";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testJSURL() {
        $urlToTest = $this->baseURL . "/assets/js/contact.js";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testHTMLURL() {
        $urlToTest = $this->baseURL . "/presos/css/design.html";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }




    public function testAboutURL() {
        $urlToTest = $this->baseURL . "/about";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testResumeURL() {
        $urlToTest = $this->baseURL . "/resume";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBookURL() {
        $urlToTest = $this->baseURL . "/book";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testContactURL() {
        $urlToTest = $this->baseURL . "/contact";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }
    public function testThanksURL() {
        $urlToTest = $this->baseURL . "/thanks";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testStaticCSSPracticalPresoURL() {
        $urlToTest = $this->baseURL . "/max/2013/practicalcss/preso/index.html";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

     public function testStaticCSSPracticalPresoFolderDefaultURL() {
        $urlToTest = $this->baseURL . "/max/2013/practicalcss/preso/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testStaticProgrammingPresoURL() {
        $urlToTest = $this->baseURL . "/max/2013/programmingcss/preso/index.html";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testStaticProgrammingPresoFolderDefaultURL() {
        $urlToTest = $this->baseURL . "/max/2013/programmingcss/preso/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testStaticAnimatePresoFolderDefaultURL() {
        $urlToTest = $this->baseURL . "/presos/animate_reveal/";
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