<?php
class URLTest extends PHPUnit_Framework_TestCase
{
    

    private $baseURL = "http://localhost:8080";

    public function testMainURL() {
        $urlToTest = $this->baseURL;
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogURL() {
        $urlToTest = $this->baseURL . "/blog/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogPostURL() {
        $urlToTest = $this->baseURL . "/blog/index.php/little-update-to-brackets-reflow-cleaner-2/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogTagURL() {
        $urlToTest = $this->baseURL . "/blog/index.php/tag/ant/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogArchiveURL() {
        $urlToTest = $this->baseURL . "/blog/index.php/2014/01/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogRedirectURL() {
        $urlToTest = $this->baseURL . "/blog";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==301, $status . " " . $urlToTest);
    }

    public function testSVGURL() {
        $urlToTest = $this->baseURL . "/max/2013/programmingcss/preso/img/zeldman.svg";
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





    public function getStatusCode($url){
        $headers = get_headers($url);
        $status_array = explode(" ", $headers[0]);
        return $status_array[1];
    }


}
;?>