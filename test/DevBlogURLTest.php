<?php
class URLTest extends PHPUnit_Framework_TestCase
{
    

    private $blogURL = "http://localhost:8082";


    public function testBlogURL() {
        $urlToTest = $this->blogURL . "/blog/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogPostURL() {
        $urlToTest = $this->blogURL . "/blog/index.php/little-update-to-brackets-reflow-cleaner-2/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogTagURL() {
        $urlToTest = $this->blogURL . "/blog/index.php/tag/ant/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogArchiveURL() {
        $urlToTest = $this->blogURL . "/blog/index.php/2014/01/";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==200, $status . " " . $urlToTest);
    }

    public function testBlogRedirectURL() {
        $urlToTest = $this->blogURL . "/blog";
        $status = $this->getStatusCode($urlToTest);
        $this->assertTrue($status==301, $status . " " . $urlToTest);
    }





    public function getStatusCode($url){
        $headers = get_headers($url);
        $status_array = explode(" ", $headers[0]);
        return $status_array[1];
    }


}
;?>